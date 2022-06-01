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
}
