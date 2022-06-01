<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTotalPopulationToDistrictsTable extends Migration
{
    public function up()
    {
        $totalPopulation = [
            'total_population'           => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'null' => true,
            ],
        ];

        $this->forge->addColumn('districts', $totalPopulation);
    }

    public function down()
    {

        $this->forge->dropColumn('districts', 'total_population');
    }
}
