<?php

namespace App\Models;

use CodeIgniter\Model;

class PharmaciesModel extends Model
{
    protected $table            = 'pharmacies';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = [
        'id_districts',
        'name',
        'address',
        'longitude',
        'latitude',
        'sia_number',
        'sia_expiration_date',
        'pharmacist_name',
        'pharmacist_sipa_number',
    ];

    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    public function joinWithDistrict()
    {
        $builder =  $this->db->table('pharmacies')
            ->select('pharmacies.*, districts.name as district_name')
            ->join('districts', 'districts.id = pharmacies.id_districts');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
