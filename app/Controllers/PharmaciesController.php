<?php

namespace App\Controllers;

use App\Models\DistrictModel;
use App\Models\PharmaciesModel;

class PharmaciesController extends BaseController
{
    public  function __construct()
    {
        $this->model = new PharmaciesModel();
    }
    public function index()
    {
        $keywords = $this->request->getVar('keywords');
        $keywords = $keywords ?  trim($keywords) : null;
        $pharmacies = [];
        $pharmacies = $this->model->getWithDistricts($keywords)->getResultArray();

        return view('pharmacies/pharmacies', [
            'page' => 'pharmacies',
            'pharmacies' => $pharmacies,
            'keywords' => $keywords
        ]);
    }
}
