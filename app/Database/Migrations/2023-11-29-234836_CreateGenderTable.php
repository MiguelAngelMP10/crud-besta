<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGenderTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('gender');
    }

    public function down(): void
    {
        $this->forge->dropTable('gender');
    }
}
