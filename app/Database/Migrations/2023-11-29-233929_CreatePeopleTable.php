<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePeopleTable extends Migration
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
                'constraint' => '100',
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'middle_name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'age' => [
                'type' => 'INT',
                'constraint' => 3,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('people');
    }

    public function down(): void
    {
        $this->forge->dropTable('people');
    }
}
