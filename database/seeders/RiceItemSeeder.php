<?php
namespace Database\Seeders;

use App\Models\RiceItem;
use Illuminate\Database\Seeder;

class RiceItemSeeder extends Seeder
{
    public function run()
    {
        $riceItems = [
            [
                'name' => 'Jasmine Rice',
                'price' => 85.50,
                'stock' => 150,
                'description' => 'Premium imported Jasmine rice, fragrant and soft texture.'
            ],
            [
                'name' => 'Brown Rice',
                'price' => 95.00,
                'stock' => 80,
                'description' => 'Healthy whole grain brown rice, rich in fiber and nutrients.'
            ],
            [
                'name' => 'Dinorado Rice',
                'price' => 120.75,
                'stock' => 60,
                'description' => 'Premium Philippine Dinorado rice, sticky and flavorful.'
            ],
            [
                'name' => 'Basmati Rice',
                'price' => 110.25,
                'stock' => 45,
                'description' => 'Long grain Indian Basmati rice, aromatic and fluffy.'
            ],
            [
                'name' => 'Glutinous Rice',
                'price' => 90.00,
                'stock' => 30,
                'description' => 'Sticky rice perfect for native delicacies.'
            ],
        ];

        foreach ($riceItems as $item) {
            RiceItem::create($item);
        }

        echo "✅ Created " . count($riceItems) . " rice items\n";
        echo "📦 Available: Jasmine, Brown, Dinorado, Basmati, Glutinous\n";
    }
}