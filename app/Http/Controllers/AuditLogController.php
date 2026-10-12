<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display audit logs for administrators.
     */
    public function index(Request $request)
    {
        $query = AuditLog::with('user')
            ->orderByDesc('created_at')
            ->orderByDesc('audit_id');

        // Search by action, table, record ID, user ID, or user name/email.
        if ($request->filled('search')) {
            $search = trim($request->input('search'));

            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                    ->orWhere('table_name', 'like', "%{$search}%")
                    ->orWhere('record_id', 'like', "%{$search}%")
                    ->orWhere('user_id', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('action')) {
            $query->where('action', $request->input('action'));
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->input('from'));
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->input('to'));
        }

        $auditLogs = $query->paginate(15)->withQueryString();

        $actions = AuditLog::query()
            ->select('action')
            ->distinct()
            ->orderBy('action')
            ->pluck('action');

        $stats = [
            'total' => AuditLog::count(),
            'today' => AuditLog::whereDate('created_at', today())->count(),
            'users' => AuditLog::whereNotNull('user_id')
                ->distinct()
                ->count('user_id'),
        ];

        return view(
            'admin.audit-logs.index',
            compact('auditLogs', 'actions', 'stats')
        );
    }
}
