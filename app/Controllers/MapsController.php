<?php

namespace App\Controllers;

use App\Models\DistrictModel;

class MapsController extends BaseController
{
    public  function __construct()
    {
        $this->model = new DistrictModel();
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

        return view('maps/maps', [
            'geojson' => $districtData,
            'districts' => $districts,
            'did' => $did
        ]);
    }
}
