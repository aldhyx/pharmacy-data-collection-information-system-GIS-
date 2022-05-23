<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDistrictsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('districts');
    }

    public function down()
    {
        $this->forge->dropTable('districts');
    }
}
