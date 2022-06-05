<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DistrictModel;

class HomeController extends BaseController
{
    public  function __construct()
    {
        $this->model = new DistrictModel();
    }
    public function index()
    {
        $districtData = $this->model->getWithTotalPharmacies()->getResultArray();
        return view('admin/home/home', ['geojson' => $districtData]);
    }
}
