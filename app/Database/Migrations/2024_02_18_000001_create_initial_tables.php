<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInitialTables extends Migration
{
    public function up()
    {
        // Create lp12_levels table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'base_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
                'default'    => 0.00,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('lp12_levels');

        // Create component_categories table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'display_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => false,
                'default'    => 0,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('component_categories');

        // Create components table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'price_modifier' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
                'default'    => 0.00,
            ],
            'image_path' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'component_categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('components');

        // Create compatibility_map table
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'level_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'component_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['level_id', 'component_id'], false, false, 'unique_compatibility');
        $this->forge->addForeignKey('level_id', 'lp12_levels', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('component_id', 'components', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('compatibility_map');
    }

    public function down()
    {
        $this->forge->dropTable('compatibility_map');
        $this->forge->dropTable('components');
        $this->forge->dropTable('component_categories');
        $this->forge->dropTable('lp12_levels');
    }
}
