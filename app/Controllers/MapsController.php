<?php

namespace App\Controllers;

use App\Models\DistrictModel;
use App\Models\PharmaciesModel;

class MapsController extends BaseController
{
    public  function __construct()
    {
        $this->model = new DistrictModel();
        $this->modelPharmacies = new PharmaciesModel();
    }
    public function index()
    {
        $did = $this->request->getVar('did');
        if ($did) {
            $districtData = $this->model->getWithTotalPharmacies($did)->getResultArray();
        } else {
            $districtData = $this->model->getWithTotalPharmacies()->getResultArray();
        }

        $districts = $this->model->findAll();
        $pharmacies = $this->modelPharmacies->findAll();

        return view('maps/maps', [
            'page' => 'maps',
            'geojson' => $districtData,
            'districts' => $districts,
            'pharmacies' => $pharmacies,
            'did' => $did
        ]);
    }
}
