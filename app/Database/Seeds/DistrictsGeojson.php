<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DistrictsGeojson extends Seeder
{
    protected $table = 'districts';

    public function run()
    {
        // Here we read json file and convert to multidimensional array
        $path = APPPATH . 'Database/Seeds/DistrictsGeojson.json';
        $file = file_get_contents($path);
        $decodedFile = json_decode($file, true);

        $isTableExist = $this->db->tableExists($this->table);

        if ($isTableExist) {
            echo 'Table found' . "\n";
            $sql = "SELECT * FROM $this->table WHERE name = :name:";

            foreach ($decodedFile['features'] as $feature) {
                $districtName = $feature['properties']['NAMOBJ'];
                $result = $this->db->query($sql, ['name' => $districtName]);

                if ($result->getNumRows() > 0) {
                    echo '------ District ' . $districtName . ' Found' . "\n";

                    $row =  $result->getRowObject();
                    $id = $row->id;
                    $data = ['geojson' => json_encode($feature)];

                    echo "Inserting data into districts " . $districtName . "\n\n\n";

                    $this->db->query("UPDATE $this->table SET geojson = :geojson: where id = $id", $data);
                } else {
                    echo '------ Districts Not Found' . "\n";
                }
            }

            return;
        }

        echo 'Table not found' . "\n";
    }
}
