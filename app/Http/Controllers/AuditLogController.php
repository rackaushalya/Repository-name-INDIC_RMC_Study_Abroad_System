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

        // Search by action, table, record ID, or user ID.
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                    ->orWhere('table_name', 'like', "%{$search}%")
                    ->orWhere('record_id', 'like', "%{$search}%")
                    ->orWhere('user_id', 'like', "%{$search}%");
            });
        }

        $auditLogs = $query->paginate(15)->withQueryString();

        return view('admin.audit-logs.index', compact('auditLogs'));
    }
}