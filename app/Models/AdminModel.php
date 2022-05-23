<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['name', 'username', 'password'];

    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';
}
