<?php

namespace App\Controllers;

use App\Models\Internal_issuesModels;
use App\Models\External_issuesModels;
use App\Models\Interested_issuesModels;
use App\Models\Internal_descriptionModels;
use App\Models\External_descriptionModels;
use App\Models\Interested_descriptionModels;
use App\Models\StandardModels;

class Context_SelectController extends BaseController
{
    public function index()
    {
        $internal_issmodel = new Internal_issuesModels();
        $external_issmodel = new External_issuesModels();
        $interested_issmodel = new Interested_issuesModels();

        $data['data_inter_iss'] = $internal_issmodel->findAll();

        $data['data_exter_iss'] = $external_issmodel->findAll();

        $data['data_interested_iss'] = $interested_issmodel->findAll();

        echo view('layout/header');
        echo view('Database/context_select', $data);
    }

    public function Create()
    {
        $internal_issmodel = new Internal_issuesModels();
        $external_issmodel = new External_issuesModels();
        $interested_issmodel = new Interested_issuesModels();
        helper(['form']);
        $select_topic = $this->request->getVar('select_topic');
        $createdata = false;
        $rules = [
            'topic_create' => 'required|min_length[2]',
            'description_create' => 'required|min_length[2]',
        ];
        if ($this->validate($rules)) {
            $topic_create = $this->request->getVar('topic_create');
            $description_create = $this->request->getVar('description_create');
            $data = [
                'activated' => 0,
                'topic' => $topic_create,
                'description' => $description_create,
            ];
            if ($select_topic == 1) {
                $createdata = $internal_issmodel->insert($data);
            } else if ($select_topic == 2) {
                $createdata = $external_issmodel->insert($data);
            } else if ($select_topic == 3) {
                $createdata = $interested_issmodel->insert($data);
            } else {
                $createdata = false;
            }
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
                'activated' => 0,
                'topic_create' => $this->request->getVar('topic_create'),
                'description_create' => $this->request->getVar('description_create'),
            ];
            $response = [
                'success' => false,
                'message' => 'กรุณากรอกข้อมูลมากกว่า 2 ตัวอักษร!',
                'data' => $data
            ];
        }
        return $this->response->setJSON($response);
    }
    public function update()
    {
        $internal_issmodel = new Internal_issuesModels();
        $external_issmodel = new External_issuesModels();
        $interested_issmodel = new Interested_issuesModels();
        helper(['form']);
        $id = $this->request->getVar('id_');
        $check = $this->request->getVar('check');
        $activated = $this->request->getVar('activated');

        $createdata = false;
        if ($activated == 'on') {
            $status = 1;
        } else {
            $status = 0;
        }

        if ($check == 1) {
            $data = [
                'activated' => $status,
            ];
            $createdata = $internal_issmodel->update($id, $data);
        } else if ($check == 2) {
            $data = [
                'activated' => $status,
            ];
            $createdata = $external_issmodel->update($id, $data);
        } else if ($check == 3) {
            $data = [
                'activated' => $status,
            ];
            $createdata = $interested_issmodel->update($id, $data);
        } else {
            $createdata = false;
        }
        if ($createdata) {
            $response = [
                'success' => true,
                'message' => 'แก้ไขข้อมูลสำเร็จ!',
                'reload' => true,
            ];
        } else {
            $data = [
                'activated' => $status,
                'check' => $check,
            ];
            $response = [
                'success' => false,
                'message' => 'ไม่สามารถแก้ไขข้อมูลได้!',
                'data' => $data
            ];
        }
        return $this->response->setJSON($response);
    }
}
