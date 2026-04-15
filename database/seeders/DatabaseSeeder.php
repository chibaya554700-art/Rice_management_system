<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        echo "🌾 Seeding Rice Management System Database...\n";
        echo "=======================================\n\n";

        $this->call([
            UserSeeder::class,
            RiceItemSeeder::class,
        ]);

        echo "\n✅ SEEDING COMPLETE!\n";
        echo "👤 Login: admin@rice.com / password123\n";
        echo "📦 Rice items ready for orders\n";
    }
}