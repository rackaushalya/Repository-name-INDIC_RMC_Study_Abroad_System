<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Consultant;
use App\Models\ConsultantAssignment;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminConsultantTest extends TestCase
{
    use RefreshDatabase;

    private function payload(array $overrides = []): array
    {
        return array_merge([
            'first_name' => 'Eleanor',
            'last_name' => 'Vance',
            'email' => 'eleanor.vance@indicrmc.com',
            'phone' => '+91 98450 12345',
            'password' => 'secret-pass',
            'employee_code' => 'RMC-CON-001',
            'specialization' => 'UK & Europe',
            'years_of_experience' => 11,
            'max_caseload' => 2,
            'consultant_status' => 'active',
            'bio' => 'Senior UK counselor.',
        ], $overrides);
    }

    private function makeConsultant(array $overrides = []): Consultant
    {
        Role::firstOrCreate(['role_name' => 'Consultant']);

        $this->postJson('/admin/consultants', $this->payload($overrides))
            ->assertCreated();

        return Consultant::latest('consultant_id')->first();
    }

    private function makeApplication(string $reference): Application
    {
        $role = Role::firstOrCreate(['role_name' => 'Student']);

        $user = User::create([
            'role_id' => $role->role_id,
            'first_name' => 'Rohan',
            'last_name' => $reference,
            'email' => strtolower($reference) . '@example.com',
            'password_hash' => 'x',
        ]);

        $student = Student::create(['user_id' => $user->user_id]);

        return Application::create([
            'student_id' => $student->student_id,
            'application_reference' => $reference,
            'application_status' => 'Submitted',
        ]);
    }

    public function test_store_creates_user_and_consultant(): void
    {
        $this->makeConsultant();

        $consultant = Consultant::first();

        $this->assertSame('RMC-CON-001', $consultant->employee_code);
        $this->assertSame(2, $consultant->max_caseload);
        $this->assertSame('eleanor.vance@indicrmc.com', $consultant->user->email);
        $this->assertSame('Consultant', $consultant->user->role->role_name);
        $this->assertNotSame('secret-pass', $consultant->user->password_hash);
    }

    public function test_store_rejects_duplicate_email_and_missing_password(): void
    {
        $this->makeConsultant();

        $this->postJson('/admin/consultants', $this->payload([
            'employee_code' => 'RMC-CON-002',
        ]))->assertStatus(422)->assertJsonValidationErrors('email');

        $this->postJson('/admin/consultants', $this->payload([
            'email' => 'other@indicrmc.com',
            'employee_code' => 'RMC-CON-003',
            'password' => '',
        ]))->assertStatus(422)->assertJsonValidationErrors('password');
    }

    public function test_update_keeps_password_when_blank_and_syncs_account_status(): void
    {
        $consultant = $this->makeConsultant();
        $oldHash = $consultant->user->password_hash;

        $this->putJson(
            '/admin/consultants/' . $consultant->consultant_id,
            $this->payload(['password' => '', 'consultant_status' => 'inactive', 'first_name' => 'Ellie'])
        )
            ->assertOk()
            ->assertJsonPath('consultant.name', 'Ellie Vance')
            ->assertJsonPath('consultant.status', 'inactive');

        $user = $consultant->fresh()->user;
        $this->assertSame($oldHash, $user->password_hash);
        $this->assertSame('inactive', $user->account_status);
    }

    public function test_destroy_deactivates_consultant_and_login(): void
    {
        $consultant = $this->makeConsultant();

        $this->deleteJson('/admin/consultants/' . $consultant->consultant_id)
            ->assertOk()
            ->assertJsonPath('consultant.status', 'inactive');

        $this->assertDatabaseHas('consultants', [
            'consultant_id' => $consultant->consultant_id,
            'consultant_status' => 'inactive',
        ]);
        $this->assertSame('inactive', $consultant->fresh()->user->account_status);
    }

    public function test_assign_creates_assignment_and_respects_capacity(): void
    {
        $consultant = $this->makeConsultant();
        $first = $this->makeApplication('APP-1');
        $second = $this->makeApplication('APP-2');
        $third = $this->makeApplication('APP-3');

        $this->postJson("/admin/consultants/{$consultant->consultant_id}/assignments", [
            'application_id' => $first->application_id,
            'priority' => 'High',
            'notes' => 'Needs visa help',
        ])
            ->assertOk()
            ->assertJsonCount(1, 'consultant.assignedStudents')
            ->assertJsonPath('consultant.assignedStudents.0.stage', 'Consultant Assigned');

        $this->assertSame('Consultant Assigned', $first->fresh()->application_status);
        $this->assertDatabaseHas('application_status_history', [
            'application_id' => $first->application_id,
            'new_status' => 'Consultant Assigned',
        ]);
        $this->assertStringContainsString(
            'Priority: High',
            ConsultantAssignment::first()->notes
        );

        // Same application can't be assigned twice
        $this->postJson("/admin/consultants/{$consultant->consultant_id}/assignments", [
            'application_id' => $first->application_id,
        ])->assertStatus(422);

        $this->postJson("/admin/consultants/{$consultant->consultant_id}/assignments", [
            'application_id' => $second->application_id,
        ])->assertOk();

        // Capacity of 2 reached
        $this->postJson("/admin/consultants/{$consultant->consultant_id}/assignments", [
            'application_id' => $third->application_id,
        ])->assertStatus(422)->assertJsonValidationErrors('application_id');
    }

    public function test_index_renders_consultants_and_only_unassigned_applications(): void
    {
        $consultant = $this->makeConsultant();
        $assigned = $this->makeApplication('APP-ASSIGNED');
        $open = $this->makeApplication('APP-OPEN');

        $this->postJson("/admin/consultants/{$consultant->consultant_id}/assignments", [
            'application_id' => $assigned->application_id,
        ])->assertOk();

        $response = $this->get('/admin/consultants')->assertOk();

        $response->assertSee('RMC-CON-001', false);
        $response->assertSee('Eleanor Vance', false);

        $this->assertSame(
            ['APP-OPEN'],
            $response->viewData('unassignedApplications')->pluck('reference')->all()
        );
        $this->assertCount(1, $response->viewData('consultants'));
    }
}
