<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPharmaciesTable extends Migration
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
            'id_districts'    => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'null' => true,
            ],
            'name'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'address'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'longitude'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'latitude'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'sia_number'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'sia_expiration_date'  => [
                'type'       => 'DATE',
                'null' => true,
            ],
            'pharmacist_name'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'pharmacist_sipa_number'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_districts', 'districts', 'id', 'NO ACTION', 'SET NULL');
        $this->forge->createTable('pharmacies');
    }

    public function down()
    {
        $this->forge->dropTable('pharmacies');
    }
}
