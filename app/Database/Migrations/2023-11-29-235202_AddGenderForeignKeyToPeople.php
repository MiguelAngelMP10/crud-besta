<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGenderForeignKeyToPeople extends Migration
{
    public function up(): void
    {
        $this->forge->addColumn('people', [
            'gender_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ]
        ]);

        $this->forge->addForeignKey('gender_id', 'gender', 'id');
    }

    public function down(): void
    {
        $this->forge->dropForeignKey('people', 'people_gender_id_foreign');
        $this->forge->dropColumn('people', 'gender_id');
    }
}
