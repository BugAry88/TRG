<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Seed lp12_levels
        $levels_data = [
            [
                'name' => 'Majik',
                'base_price' => 2500.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Akurate',
                'base_price' => 8500.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Klimax',
                'base_price' => 25000.00,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('lp12_levels')->insertBatch($levels_data);

        // Seed component_categories
        $categories_data = [
            [
                'name' => 'Plinth',
                'display_order' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Tonearm',
                'display_order' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Cartridge',
                'display_order' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Power Supply',
                'display_order' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('component_categories')->insertBatch($categories_data);

        // Get inserted IDs for foreign key relationships
        $majik_id = 1;
        $akurate_id = 2;
        $klimax_id = 3;
        
        $plinth_id = 1;
        $tonearm_id = 2;
        $cartridge_id = 3;
        $power_supply_id = 4;

        // Seed components
        $components_data = [
            // Plinths
            [
                'category_id' => $plinth_id,
                'name' => 'Majik Plinth',
                'price_modifier' => 0.00,
                'image_path' => '/images/plinths/majik.jpg',
                'description' => 'Standard Majik level plinth with basic finish',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $plinth_id,
                'name' => 'Akurate Plinth',
                'price_modifier' => 2000.00,
                'image_path' => '/images/plinths/akurate.jpg',
                'description' => 'Enhanced Akurate level plinth with premium materials',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $plinth_id,
                'name' => 'Klimax Plinth',
                'price_modifier' => 8000.00,
                'image_path' => '/images/plinths/klimax.jpg',
                'description' => 'Premium Klimax level plinth with exotic materials',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Tonearms
            [
                'category_id' => $tonearm_id,
                'name' => 'Majik Tonearm',
                'price_modifier' => 0.00,
                'image_path' => '/images/tonearms/majik.jpg',
                'description' => 'Basic tonearm for Majik level turntables',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $tonearm_id,
                'name' => 'Akurate Tonearm',
                'price_modifier' => 1500.00,
                'image_path' => '/images/tonearms/akurate.jpg',
                'description' => 'Enhanced tonearm with improved bearings',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $tonearm_id,
                'name' => 'Ekos SE Tonearm',
                'price_modifier' => 5000.00,
                'image_path' => '/images/tonearms/ekos_se.jpg',
                'description' => 'Premium tonearm for Klimax level systems',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Cartridges
            [
                'category_id' => $cartridge_id,
                'name' => 'Krystal Cartridge',
                'price_modifier' => 0.00,
                'image_path' => '/images/cartridges/krystal.jpg',
                'description' => 'Standard cartridge for Majik and Akurate levels',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $cartridge_id,
                'name' => 'Kandid Cartridge',
                'price_modifier' => 2500.00,
                'image_path' => '/images/cartridges/kandid.jpg',
                'description' => 'High-performance cartridge for Akurate level',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $cartridge_id,
                'name' => 'Klyde Cartridge',
                'price_modifier' => 8000.00,
                'image_path' => '/images/cartridges/klyde.jpg',
                'description' => 'Reference cartridge for Klimax level systems',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            
            // Power Supplies
            [
                'category_id' => $power_supply_id,
                'name' => 'Majik Power Supply',
                'price_modifier' => 0.00,
                'image_path' => '/images/power/majik_psu.jpg',
                'description' => 'Basic power supply for Majik level',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $power_supply_id,
                'name' => 'Akurate Power Supply',
                'price_modifier' => 1200.00,
                'image_path' => '/images/power/akurate_psu.jpg',
                'description' => 'Enhanced power supply with better regulation',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => $power_supply_id,
                'name' => 'Radikal Power Supply',
                'price_modifier' => 6000.00,
                'image_path' => '/images/power/radikal.jpg',
                'description' => 'Ultimate reference power supply for Klimax level',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('components')->insertBatch($components_data);

        // Seed compatibility_map
        $compatibility_data = [
            // Majik Level (1) - compatible with basic components
            ['level_id' => $majik_id, 'component_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Plinth
            ['level_id' => $majik_id, 'component_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Tonearm
            ['level_id' => $majik_id, 'component_id' => 7, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Krystal Cartridge
            ['level_id' => $majik_id, 'component_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Power Supply
            
            // Akurate Level (2) - compatible with Majik and Akurate components
            ['level_id' => $akurate_id, 'component_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Plinth
            ['level_id' => $akurate_id, 'component_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Akurate Plinth
            ['level_id' => $akurate_id, 'component_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Tonearm
            ['level_id' => $akurate_id, 'component_id' => 5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Akurate Tonearm
            ['level_id' => $akurate_id, 'component_id' => 7, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Krystal Cartridge
            ['level_id' => $akurate_id, 'component_id' => 8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Kandid Cartridge
            ['level_id' => $akurate_id, 'component_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Power Supply
            ['level_id' => $akurate_id, 'component_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Akurate Power Supply
            
            // Klimax Level (3) - compatible with all components
            ['level_id' => $klimax_id, 'component_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Plinth
            ['level_id' => $klimax_id, 'component_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Akurate Plinth
            ['level_id' => $klimax_id, 'component_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Klimax Plinth
            ['level_id' => $klimax_id, 'component_id' => 4, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Tonearm
            ['level_id' => $klimax_id, 'component_id' => 5, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Akurate Tonearm
            ['level_id' => $klimax_id, 'component_id' => 6, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Ekos SE Tonearm
            ['level_id' => $klimax_id, 'component_id' => 7, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Krystal Cartridge
            ['level_id' => $klimax_id, 'component_id' => 8, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Kandid Cartridge
            ['level_id' => $klimax_id, 'component_id' => 9, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Klyde Cartridge
            ['level_id' => $klimax_id, 'component_id' => 10, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Majik Power Supply
            ['level_id' => $klimax_id, 'component_id' => 11, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Akurate Power Supply
            ['level_id' => $klimax_id, 'component_id' => 12, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')], // Radikal Power Supply
        ];
        $this->db->table('compatibility_map')->insertBatch($compatibility_data);
    }
}
