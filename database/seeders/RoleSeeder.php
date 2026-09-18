<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::updateOrCreate(
            ['role_name' => 'Student'],
            ['description' => 'Student / applicant using the study abroad system']
        );

        Role::updateOrCreate(
            ['role_name' => 'Consultant'],
            ['description' => 'Consultant who manages student consultations and applications']
        );

        Role::updateOrCreate(
            ['role_name' => 'Admin'],
            ['description' => 'Administrator who manages the system']
        );
    }
}