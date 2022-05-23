<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAdminsTable extends Migration
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
            'username'  => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'password'  => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => 100,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->createTable('admins');
    }

    public function down()
    {
        $this->forge->dropTable('admins');
    }
}
