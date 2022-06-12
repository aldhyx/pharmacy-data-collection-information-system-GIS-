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

    public function getWithDistricts($keywords = null)
    {
        $builder =  $this->db->table('pharmacies');
        if (!$keywords) {
            $query = $builder->select('pharmacies.*, districts.name as district_name')
                ->join('districts', 'districts.id = pharmacies.id_districts');
            return $query->get();
        } else {
            $query = $builder->select('pharmacies.*, districts.name as district_name')
                ->like('pharmacies.name', $keywords, 'both')
                ->join('districts', 'districts.id = pharmacies.id_districts');
            return $query->get();
        }
    }
}
