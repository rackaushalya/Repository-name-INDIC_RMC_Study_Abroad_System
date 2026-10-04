<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * JSON endpoints behind the dashboard's notification popup.
 */
class StudentNotificationController extends Controller
{
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
