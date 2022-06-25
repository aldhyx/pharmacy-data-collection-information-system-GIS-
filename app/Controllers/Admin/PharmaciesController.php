<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DistrictModel;
use App\Models\PharmaciesModel;

class PharmaciesController extends BaseController
{
    public  function __construct()
    {
        $this->model = new PharmaciesModel();
        $this->session = session();
    }
    public function index()
    {
        $pharmacies = $this->model->getWithDistricts()->getResultArray();

        return view('admin/pharmacies/pharmacies', [
            'pharmacies' => $pharmacies
        ]);
    }

    public  function create()
    {
        $districtModel = new DistrictModel();
        $districtData = $districtModel->findAll();

        return view('admin/pharmacies/pharmacies_create', [
            'districts' => $districtData
        ]);
    }

    public function delete($id = null)
    {
        if ($id == null) {
            return redirect()->to(base_url(route_to('adminHome')));
        }

        $this->session->setFlashdata('success', "Berhasil menghapus data apotek.");
        $this->model->delete($id);
        return redirect()->back();
    }

    public function update($id = null)
    {
        $districtModel = new DistrictModel();
        $districtData = $districtModel->findAll();

        $pharmacyData = $this->model->find($id);

        return view(
            'admin/pharmacies/pharmacies_update',
            [
                'districts' => $districtData,
                'pharmacy' => $pharmacyData
            ]
        );
    }

    public  function store()
    {
        $data = [
            'id_districts' => $this->request->getPost('district_id'),
            'name' => $this->request->getPost('pharmacy_name'),
            'pharmacist_name' => $this->request->getPost('pharmacist_name'),
            'sipa_number' => $this->request->getPost('sipa_number'),
            'sia_number' => $this->request->getPost('sia_number'),
            'sipa_expiration_date' => $this->request->getPost('sipa_expiration_date'),
            'address' => $this->request->getPost('address'),
            'longitude' => $this->request->getPost('longitude'),
            'latitude' => $this->request->getPost('latitude'),
        ];

        $id = $this->request->getPost('id');
        if ($id) {
            $data['id'] = $id;
            $this->session->setFlashdata('success', 'Berhasil mengubah data apotek');
        } else {
            $this->session->setFlashdata('success', 'Berhasil menyimpan data apotek');
        }

        $this->model->save($data);
        return redirect()->to(base_url(route_to('adminPharmacies')));
    }
}
