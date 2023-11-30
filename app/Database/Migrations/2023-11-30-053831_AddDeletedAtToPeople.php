<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDeletedAtToPeople extends Migration
{
    public function up()
    {
        $this->forge->addColumn('people', [
            'deleted_at' => ['type' => 'datetime', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('people', 'deleted_at');
    }
}
