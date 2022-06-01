<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGeojsonToDistrictsTable extends Migration
{
    public function up()
    {
        $geojson = [
            'geojson'  => [
                'type' => 'json',
                'null' => true,
            ],
        ];

        $this->forge->addColumn('districts', $geojson);
    }

    public function down()
    {

        $this->forge->dropColumn('districts', 'geojson');
    }
}
