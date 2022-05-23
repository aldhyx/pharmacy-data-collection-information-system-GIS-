<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Districts extends Seeder
{
    public function run()
    {

        $data = [
            ['name' => 'Oebobo'],
            ['name' => 'Kelapa Lima'],
            ['name' => 'Kota Lama'],
            ['name' => 'Kota Raja'],
            ['name' => 'Maulafa'],
            ['name' => 'Alak']
        ];

        $this->db->table('districts')->insertBatch($data);
    }
}
