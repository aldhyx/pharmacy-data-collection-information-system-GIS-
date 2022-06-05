<?php

namespace App\Models;

use CodeIgniter\Model;

class DistrictModel extends Model
{
    protected $table            = 'districts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['name', 'total_population'];

    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function getWithTotalPharmacies()
    {

        // Manual query
        // $builder =  $this->db->query("SELECT districts.*, count(pharmacies.id_districts) FROM districts LEFT JOIN pharmacies ON districts.id = pharmacies.id_districts GROUP BY districts.id");
        // $query = $builder->getResultArray();
        $builder = $this->db->table("districts");
        $query = $builder->select("districts.*")
            ->selectCount("pharmacies.id_districts", "total_pharmacies")
            ->join('pharmacies', 'pharmacies.id_districts = districts.id', 'LEFT')
            ->groupBy('districts.id');

        return $query->get();
    }
}
