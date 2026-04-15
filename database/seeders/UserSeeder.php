<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@rice.com',
            'password' => Hash::make('password123'),
        ]);

        // Additional test users
        User::create([
            'name' => 'Manager',
            'email' => 'manager@rice.com', 
            'password' => Hash::make('password123'),
        ]);

        echo "✅ Created 2 admin users:\n";
        echo "   Email: admin@rice.com / Password: password123\n";
        echo "   Email: manager@rice.com / Password: password123\n";
    }
}