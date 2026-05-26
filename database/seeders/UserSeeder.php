<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder {
    public function run(): void {
        for ($i=1; $i<=3; $i++) {
            User::create([
                'name' => 'Proposer ' . $i,
                'email' => "proposer{$i}@uniportal.com",
                'password' => Hash::make('password'),
                'unique_id' => "PROP-00{$i}",
                'role' => 'proposer',
                'status' => 'approved',
                'email_verified_at' => now(),
            ]);
        }
        for ($i=1; $i<=3; $i++) {
            User::create([
                'name' => 'End User ' . $i,
                'email' => "user{$i}@uniportal.com",
                'password' => Hash::make('password'),
                'unique_id' => "USER-00{$i}",
                'role' => 'end_user',
                'status' => 'approved',
                'email_verified_at' => now(),
            ]);
        }
    }
}
