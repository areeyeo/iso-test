<?php

namespace App\Controllers;
use App\Models\RoleModels;

class Role_Controller extends BaseController
{
    public function index()
    {
        $RoleModels = new RoleModels();
        $data['data'] = $RoleModels->findAll();

        echo view('layout/header');
        echo view('Database/Role_Management' , $data);
    }
    
    public function create_Role()
    {
        helper(['form']);
        $rules = [
            'namerole'          => 'required|min_length[2]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $roleModels = new RoleModels();
            $data = [
                'name_role'     => $this->request->getVar('namerole'),
            ];
            $roleModels->save($data);
            $response = [
                'success' => true,
                'message' => 'สร้างข้อมูล Role สำเร็จ',
                'reload' => true,
            ];
        } else {
            $data['validation'] = $this->validator;
            $data = [
                'name_role'     => $this->request->getVar('namerole'),
            ];
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(), // Get validation errors
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function edit_Role($id_role = null)
    {
        helper(['form']);
        $rules = [
            'namerole'          => 'required|min_length[2]|max_length[200]',
        ];

        if ($this->validate($rules)) {
            $roleModels = new RoleModels();

            $data = [
                'name_role'     => $this->request->getVar('namerole'),
            ];
            $roleModels->update($id_role, $data);
            $response = [
                'success' => true,
                'message' => 'อัปเดตข้อมูล Role สำเร็จ',
                'reload' => true,
            ];
        } else {
            $data['validation'] = $this->validator;
            $data = [
                'name_role'     => $this->request->getVar('namerole'),
            ];
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(), // Get validation errors
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }
}
