<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationStatusHistory;
use App\Models\Consultant;
use App\Models\ConsultantAssignment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * JSON endpoints behind the admin consultants page.
 */
class AdminConsultantController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate(
            $this->rules()
        );

        $role = Role::where('role_name', 'Consultant')->first();

        if (!$role) {
            throw ValidationException::withMessages([
                'email' => 'Consultant role is not configured.',
            ]);
        }

        $consultant = DB::transaction(function () use ($validated, $role) {
            $user = User::create([
                'role_id' => $role->role_id,
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'password_hash' => Hash::make($validated['password']),
                'account_status' => $this->accountStatusFor($validated['consultant_status']),
            ]);

            return Consultant::create([
                'user_id' => $user->user_id,
                'employee_code' => $validated['employee_code'],
                'specialization' => $validated['specialization'],
                'years_of_experience' => $validated['years_of_experience'],
                'max_caseload' => $validated['max_caseload'],
                'bio' => $validated['bio'] ?? null,
                'consultant_status' => $validated['consultant_status'],
            ]);
        });

        return response()->json([
            'message' => 'Consultant created successfully.',
            'consultant' => $consultant->fresh()->toAdminArray(),
        ], 201);
    }

    public function update(Request $request, Consultant $consultant): JsonResponse
    {
        $validated = $request->validate(
            $this->rules($consultant)
        );

        DB::transaction(function () use ($validated, $consultant) {
            $user = $consultant->user;

            $user->fill([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'account_status' => $this->accountStatusFor($validated['consultant_status']),
            ]);

            if (!empty($validated['password'])) {
                $user->password_hash = Hash::make($validated['password']);
            }

            $user->save();

            $consultant->update([
                'employee_code' => $validated['employee_code'],
                'specialization' => $validated['specialization'],
                'years_of_experience' => $validated['years_of_experience'],
                'max_caseload' => $validated['max_caseload'],
                'bio' => $validated['bio'] ?? null,
                'consultant_status' => $validated['consultant_status'],
            ]);
        });

        return response()->json([
            'message' => 'Consultant updated successfully.',
            'consultant' => $this->freshPayload($consultant),
        ]);
    }

    /**
     * Deactivate (never hard-delete) so existing cases stay intact.
     */
    public function destroy(Consultant $consultant): JsonResponse
    {
        DB::transaction(function () use ($consultant) {
            $consultant->update([
                'consultant_status' => 'inactive',
            ]);

            $consultant->user?->update([
                'account_status' => 'inactive',
            ]);
        });

        return response()->json([
            'message' => 'Consultant deactivated successfully.',
            'consultant' => $this->freshPayload($consultant),
        ]);
    }

    /**
     * Assign an application (student case) to a consultant.
     */
    public function assign(Request $request, Consultant $consultant): JsonResponse
    {
        $validated = $request->validate([
            'application_id' => [
                'required',
                'integer',
                'exists:applications,application_id',
            ],
            'priority' => [
                'nullable',
                'in:Normal,High,Urgent',
            ],
            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        if ($consultant->consultant_status !== 'active') {
            throw ValidationException::withMessages([
                'application_id' => 'Cases can only be assigned to active consultants.',
            ]);
        }

        $openCases = $consultant->activeAssignments()->count();
        $capacity = $consultant->max_caseload ?: 15;

        if ($openCases >= $capacity) {
            throw ValidationException::withMessages([
                'application_id' => "This consultant is at full capacity ({$openCases} / {$capacity} cases).",
            ]);
        }

        DB::transaction(function () use ($validated, $consultant) {
            $application = Application::lockForUpdate()
                ->findOrFail($validated['application_id']);

            $alreadyAssigned = ConsultantAssignment::where('application_id', $application->application_id)
                ->where('assignment_status', 'Active')
                ->exists();

            if ($alreadyAssigned) {
                throw ValidationException::withMessages([
                    'application_id' => 'This application already has an active consultant.',
                ]);
            }

            $priority = $validated['priority'] ?? 'Normal';
            $notes = trim($validated['notes'] ?? '');

            ConsultantAssignment::create([
                'application_id' => $application->application_id,
                'consultant_id' => $consultant->consultant_id,
                'assigned_by' => Auth::id(),
                'assignment_status' => 'Active',
                'assigned_at' => now(),
                'notes' => trim("[Priority: {$priority}] {$notes}"),
            ]);

            if (in_array($application->application_status, ['Submitted', 'Under Review'], true)) {
                ApplicationStatusHistory::create([
                    'application_id' => $application->application_id,
                    'old_status' => $application->application_status,
                    'new_status' => 'Consultant Assigned',
                    'changed_by' => Auth::id(),
                    'remarks' => 'Assigned to ' . $consultant->employee_code,
                    'changed_at' => now(),
                ]);

                $application->update([
                    'application_status' => 'Consultant Assigned',
                ]);
            }
        });

        return response()->json([
            'message' => 'Case assigned successfully.',
            'consultant' => $this->freshPayload($consultant),
        ]);
    }

    private function freshPayload(Consultant $consultant): array
    {
        return Consultant::findOrFail($consultant->consultant_id)
            ->toAdminArray();
    }

    /**
     * Only active consultants can log in.
     */
    private function accountStatusFor(string $consultantStatus): string
    {
        return $consultantStatus === 'inactive' ? 'inactive' : 'active';
    }

    private function rules(?Consultant $consultant = null): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:100',
            ],
            'last_name' => [
                'nullable',
                'string',
                'max:100',
            ],
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')
                    ->ignore($consultant?->user_id, 'user_id'),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],
            'password' => [
                $consultant ? 'nullable' : 'required',
                'string',
                'min:8',
            ],
            'employee_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('consultants', 'employee_code')
                    ->ignore($consultant?->consultant_id, 'consultant_id'),
            ],
            'specialization' => [
                'required',
                'string',
                'max:255',
            ],
            'years_of_experience' => [
                'required',
                'integer',
                'min:0',
                'max:60',
            ],
            'max_caseload' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],
            'bio' => [
                'nullable',
                'string',
            ],
            'consultant_status' => [
                'required',
                'in:active,inactive,on_leave',
            ],
        ];
    }
}
