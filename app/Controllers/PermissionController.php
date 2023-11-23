<?php

namespace App\Controllers;

use App\Models\UserModels;
use App\Models\Topic_tableModels;

class PermissionController extends BaseController
{
    public function index()
    {
        $usermodel = new UserModels();
        $Topic_tableModels = new Topic_tableModels();

        $data['user_data'] = $usermodel->findAll();
        $data['topic_table'] = $Topic_tableModels->findAll();
        echo view('layout/header');
        echo view('Database/permission', $data);
    }

    public function CreateData()
    {
        helper(['form']);
        $Topic_tableModels = new Topic_tableModels();
        $createSelect = $this->request->getPost('Create_Select');
        $reviewSelect = $this->request->getPost('Review_Select');
        $approvedSelect = $this->request->getPost('Approved_Select');
        $id_topic = $this->request->getPost('Toic');
        $data = [
            'create_id_user' => $createSelect,
            'review_id_user' => $reviewSelect,
            'approved_id_user' => $approvedSelect,
        ];
        $update = $Topic_tableModels->update($id_topic, $data);

        if ($update) {
            $response = [
                'success' => true,
                'message' => 'อัปเดตข้อมูลสำเร็จ!',
                'reload' => true,
                'data' => $data,

            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'ไม่สามารถอัปเดตข้อมูลได้!',
                'data' => $data,
                'reload' => false,

            ];
        }
        return $this->response->setJSON($response);
    }
}