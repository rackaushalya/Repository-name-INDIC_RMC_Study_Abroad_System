<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\DeadlineAlerts;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * JSON endpoints behind the dashboard's notification popup.
 */
class StudentNotificationController extends Controller
{
    /**
     * Full notifications page, with deadline reminders filterable on their own.
     */
    public function index(Request $request, DeadlineAlerts $alerts)
    {
        $user = Auth::user();
        $student = $user?->student;

        if (!$user || !$student) {
            abort(403);
        }

        $alerts->sync($student);

        $filter = in_array($request->query('filter'), ['unread', 'deadlines'], true)
            ? $request->query('filter')
            : 'all';

        $query = $user->notifications()->latest('created_at')->latest('notification_id');

        if ($filter === 'unread') {
            $query->unread();
        } elseif ($filter === 'deadlines') {
            $query->where('notification_type', 'like', DeadlineAlerts::TYPE_PREFIX . '%');
        }

        $notifications = $query->paginate(15)->withQueryString();

        $counts = [
            'all' => $user->notifications()->count(),
            'unread' => $user->notifications()->unread()->count(),
            'deadlines' => $user->notifications()->where('notification_type', 'like', DeadlineAlerts::TYPE_PREFIX . '%')->count(),
        ];

        return view('student.notifications', compact('notifications', 'filter', 'counts'));
    }

    /** Route-friendly name for markAllAsRead(). */
    public function readAll(): JsonResponse
    {
        return $this->markAllAsRead();
    }

    /** Mark one of the signed-in student's notifications as read. */
    public function markRead(int $id): JsonResponse
    {
        return $this->markAsRead($this->ownNotification($id));
    }

    public function destroy(int $id)
    {
        $this->ownNotification($id)->delete();

        return request()->expectsJson()
            ? response()->json(['unread' => Auth::user()->notifications()->unread()->count()])
            : back()->with('success', 'Notification removed.');
    }

    private function ownNotification(int $id): Notification
    {
        $user = Auth::user();
        $notification = Notification::findOrFail($id);

        if (!$user || !$user->student || (int) $notification->user_id !== (int) $user->user_id) {
            abort(403);
        }

        return $notification;
    }

    /**
     * Polled by the dashboard so new notifications appear without a reload.
     * Returns the same markup the page renders, so the two can't drift.
     */
    public function feed(): JsonResponse
    {
        $user = Auth::user();

        if (!$user || !$user->student) {
            abort(403);
        }

        $notifications = $user->notifications()
            ->latest('created_at')
            ->latest('notification_id')
            ->take(10)
            ->get();

        return response()->json([
            'unread' => $user->notifications()->unread()->count(),
            'has_any' => $notifications->isNotEmpty(),
            'popup_html' => view('student.partials.notification-popup-items', compact('notifications'))->render(),
            'card_html' => view('student.partials.notification-card-items', compact('notifications'))->render(),
        ]);
    }

    public function markAsRead(Notification $notification): JsonResponse
    {
        $user = Auth::user();

        if (!$user || !$user->student || (int) $notification->user_id !== (int) $user->user_id) {
            abort(403);
        }

        if (!$notification->is_read) {
            $notification->update(['is_read' => true]);
        }

        return response()->json([
            'unread' => $user->notifications()->unread()->count(),
        ]);
    }

    public function markAllAsRead(): JsonResponse
    {
        $user = Auth::user();

        if (!$user || !$user->student) {
            abort(403);
        }

        $user->notifications()->unread()->update(['is_read' => true]);

        return response()->json(['unread' => 0]);
    }
}
