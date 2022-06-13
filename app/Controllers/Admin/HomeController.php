<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DistrictModel;
use App\Models\PharmaciesModel;

class HomeController extends BaseController
{
    public  function __construct()
    {
        $this->model = new DistrictModel();
        $this->modelPharmacies = new PharmaciesModel();
    }
    public function index()
    {
        $districtData = $this->model->getWithTotalPharmacies()->getResultArray();
        $pharmacies = $this->modelPharmacies->findAll();

        return view('admin/home/home', [
            'geojson' => $districtData,
            'pharmacies' => $pharmacies,
        ]);
    }
}
