<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder {
    public function run(): void {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@uniportal.com',
            'password' => Hash::make('password'),
            'unique_id' => 'ADMIN-001',
            'role' => 'admin',
            'status' => 'approved',
            'email_verified_at' => now(),
        ]);
    }
}
