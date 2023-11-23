<?php

namespace App\Controllers;

use App\Models\RequirementModels;

class RequirementController extends BaseController
{

    public function index()
    {
        $RequirementModels = new RequirementModels();

        $data['data_requirement'] = $RequirementModels->findAll();

        echo view('layout/header');
        echo view('Database/requirement', $data);
    }

    public function Create()
    {
        $RequirementModels = new RequirementModels();
        helper(['form']);
        $createdata = false;
        $rules = [
            'topic_create' => 'required|min_length[2]',
            'description_create' => 'required|min_length[2]',
        ];
        if ($this->validate($rules)) {
            $data = [
                'topic_standart' => $this->request->getVar('topic_create'),
                'details' => $this->request->getVar('description_create'),
            ];
            $createdata = $RequirementModels->insert($data);
            if ($createdata) {
                $response = [
                    'success' => true,
                    'message' => 'สร้างข้อมูลสำเร็จ!',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'ไม่สามารถสร้างข้อมูลได้!',
                    'data' => $data
                ];
            }
            return $this->response->setJSON($response);
        } else {
            $data = [
                'topic_standart' => $this->request->getVar('topic_create'),
                'details' => $this->request->getVar('description_create'),
            ];
            $response = [
                'success' => false,
                'message' => 'กรุณากรอกข้อมูลมากกว่า 1 ตัวอักษร!',
                'data' => $data
            ];
        }
        return $this->response->setJSON($response);
    }
    public function update()
    {
        $RequirementModels = new RequirementModels();
        helper(['form']);
        $rules = [
            'topic_' => 'required|min_length[2]',
            'details_' => 'required|min_length[2]',
        ];
        if ($this->validate($rules)) {
            $id = $this->request->getVar('id_');
            $data = [
                'topic_standart' => $this->request->getVar('topic_'),
                'details' => $this->request->getVar('details_'),
            ];
            $createdata = $RequirementModels->update($id, $data);
            if ($createdata) {
                $response = [
                    'success' => true,
                    'message' => 'อัปเดตข้อมูลสำเร็จ!',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'ไม่สามารถอัปเดตข้อมูลได้!',
                    'data' => $data
                ];
            }
            return $this->response->setJSON($response);
        } else {
            $data = [
                'topic_standart' => $this->request->getVar('topic_'),
                'details' => $this->request->getVar('details_'),
            ];
            $response = [
                'success' => false,
                'message' => 'กรุณากรอกข้อมูลมากกว่า 1 ตัวอักษร!',
                'data' => $data
            ];
        }
        return $this->response->setJSON($response);
    }
}
