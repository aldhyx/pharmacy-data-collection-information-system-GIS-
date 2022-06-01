<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DistrictModel;

class DistrictsController extends BaseController
{
    public  function __construct()
    {
        $this->model = new DistrictModel();
        $this->session = session();
    }
    public function index()
    {
        $districts = $this->model->findAll();

        return view('admin/districts/districts', [
            'districts' => $districts
        ]);
    }

    public function update($id = null)
    {
        $districtData = $this->model->find($id);

        return view(
            'admin/districts/districts_update',
            [
                'district' => $districtData
            ]
        );
    }

    public  function store()
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'total_population' => $this->request->getPost('total_population'),
        ];

        $id = $this->request->getPost('id');
        if ($id) {
            $data['id'] = $id;
            $this->session->setFlashdata('success', 'Berhasil mengubah data kecamatan');
        } else {
            $this->session->setFlashdata('success', 'Berhasil menyimpan data kecamatan');
        }

        $this->model->save($data);
        return redirect()->to(base_url(route_to('adminDistricts')));
    }
}
