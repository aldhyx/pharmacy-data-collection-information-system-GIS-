<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPharmacistTable extends Migration
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
            'id_pharmacies'    => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'null' => true,
            ],
            'name'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sipa_number'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pharmacies', 'pharmacies', 'id', 'NO ACTION', 'SET NULL');
        $this->forge->createTable('pharmacist');
    }

    public function down()
    {
        $this->forge->dropTable('pharmacist');
    }
}
