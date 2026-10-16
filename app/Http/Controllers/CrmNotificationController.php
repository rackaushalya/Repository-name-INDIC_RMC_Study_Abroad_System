<?php

namespace App\Http\Controllers;

use App\Mail\CrmNotificationMail;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * The "Email Notifications" feature.
 *
 * Every "Send Notification" does TWO things now:
 *   1. Saves a row into the "notifications" table — the same table
 *      the Student side reads from, so it shows up instantly in that
 *      user's notification bell on their own dashboard.
 *   2. Actually sends a real email (via Mail::send below) using the
 *      mailer configured in .env. For development/testing this is
 *      pointed at Mailpit, a local email-catching tool, so sent
 *      emails can be viewed at http://127.0.0.1:8025 instead of
 *      going out onto the real internet.
 */
class CrmNotificationController extends Controller
{
    /**
     * List every notification ever sent, newest first.
     */
    public function index()
    {
        // with('user') loads each notification's recipient in the
        // same query, so the table can show "Sent to: John Silva"
        // instead of just a user_id number.
        $notifications = Notification::with('user')
            ->latest('created_at')
            ->paginate(20);

        // Full user list, used to populate the "Recipient" dropdown
        // on the Send Notification form.
        $users = User::orderBy('first_name')->get();

        return view(
            'admin.notifications.index',
            compact('notifications', 'users')
        );
    }

    /**
     * Show the blank "Send Notification" form.
     */
    public function create()
    {
        $users = User::orderBy('first_name')->get();

        return view('admin.notifications.create', compact('users'));
    }

    /**
     * Handle the form submission: validate, save the in-app
     * notification, then send the matching email.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => [
                'required',
                'integer',
                'exists:users,user_id', // must be a real, existing user
            ],
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'message' => [
                'required',
                'string',
            ],
            'notification_type' => [
                'nullable', // optional field
                'string',
                'max:100',
            ],
        ]);

        // Every new notification starts out unread, timestamped now.
        $validated['is_read'] = false;
        $validated['created_at'] = now();

        // create() both saves the row AND returns the new Notification
        // object (with its notification_id etc. filled in) — we need
        // that object below to build the email from it.
        $notification = Notification::create($validated);

        // Load the recipient's User record so we can get their email
        // address — $validated only has the user_id number, not the
        // full user.
        $recipient = User::find($validated['user_id']);

        // Wrapped in try/catch so that if the email fails to send for
        // any reason (e.g. Mailpit isn't running), the notification
        // the admin just created is NOT lost — it's already saved
        // above and still shows up in the recipient's notification
        // bell either way. We just log the mail problem instead of
        // crashing the whole page.
        try {
            if ($recipient && $recipient->email) {
                Mail::to($recipient->email)
                    ->send(new CrmNotificationMail($notification));
            }
        } catch (\Exception $e) {
            Log::warning(
                'CRM notification email failed to send: ' .
                $e->getMessage()
            );
        }

        return redirect()
            ->route('admin.notifications.index')
            ->with(
                'success',
                'Notification sent successfully.'
            );
    }

    /**
     * Delete a notification. Laravel automatically turns the
     * {notification} segment of the URL into the matching Notification
     * model for us (route model binding), so there's no manual lookup.
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()
            ->route('admin.notifications.index')
            ->with(
                'success',
                'Notification deleted.'
            );
    }
}
