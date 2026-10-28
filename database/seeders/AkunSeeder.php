<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('SEED_DEMO_PASSWORD');

        if (blank($password)) {
            $this->command?->warn('SEED_DEMO_PASSWORD is not set. Skipping demo account seeding.');

            return;
        }

        $accounts = [
            [
                'name' => 'Administrator',
                'email' => 'admin@example.test',
                'nip' => '000000000000000001',
                'role' => 'admin',
            ],
            [
                'name' => 'Staff 1',
                'email' => 'staff1@example.test',
                'nip' => '000000000000000002',
                'role' => 'petugas',
            ],
            [
                'name' => 'Staff 2',
                'email' => 'staff2@example.test',
                'nip' => '000000000000000003',
                'role' => 'petugas',
            ],
            [
                'name' => 'Staff 3',
                'email' => 'staff3@example.test',
                'nip' => '000000000000000004',
                'role' => 'petugas',
            ],
            [
                'name' => 'Staff 4',
                'email' => 'staff4@example.test',
                'nip' => '000000000000000005',
                'role' => 'petugas',
            ],
            [
                'name' => 'Staff 5',
                'email' => 'staff5@example.test',
                'nip' => '000000000000000006',
                'role' => 'petugas',
            ],
        ];

        foreach ($accounts as $account) {
            User::updateOrCreate(
                ['email' => $account['email']],
                [...$account, 'password' => $password],
            );
        }
    }
}
