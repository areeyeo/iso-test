<?php

namespace App\Controllers;

use App\Models\UserModels;
use App\Models\RoleModels;
use App\Models\GroupModels;

class User_Controller extends BaseController
{
    public function index()
    {
        $UserModels = new UserModels();
        $RoleModels = new RoleModels();
        $GroupModels = new GroupModels();
        $data['data_user'] = $UserModels->findAll();
        $data['data_role'] = $RoleModels->findAll();
        $data['data_group'] = $GroupModels->findAll();

        echo view('layout/header');
        echo view('Database/user_list', $data);
    }

    public function create_User()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[200]',
            'last'          => 'required|min_length[2]|max_length[200]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user_table.email_user]',
        ];

        if ($this->validate($rules)) {
            $userModels = new UserModels();
            $data = [
                'name_user'     => $this->request->getVar('name'),
                'lastname_user'     => $this->request->getVar('last'),
                'email_user'    => $this->request->getVar('email'),
                'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'group' => $this->request->getVar('group_select'),
                'role' => $this->request->getVar('role_select'),
                'status' => '0',
            ];
            $userModels->save($data);
            $response = [
                'success' => true,
                'message' => 'สร้างข้อมูล User สำเร็จ',
                'reload' => true,
            ];
        } else {
            $data['validation'] = $this->validator;
            $data = [
                'name_user'     => $this->request->getVar('name'),
                'lastname_user'     => $this->request->getVar('last'),
                'email_user'    => $this->request->getVar('email'),
                'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'group' => $this->request->getVar('group_select'),
                'role' => $this->request->getVar('role_select'),
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

    public function edit_User($id_user = null)
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[200]',
            'last'          => 'required|min_length[2]|max_length[200]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user_table.email_user,id_user,'.$id_user.']',
        ];

        if ($this->validate($rules)) {
            $userModels = new UserModels();

            $activated = $this->request->getVar('activated');
            if ($activated == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }
            $data = [
                'name_user'     => $this->request->getVar('name'),
                'lastname_user'     => $this->request->getVar('last'),
                'email_user'    => $this->request->getVar('email'),
                'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'group' => $this->request->getVar('group_select'),
                'role' => $this->request->getVar('role_select'),
                'status' => $status,
            ];
            $userModels->update($id_user, $data);
            $response = [
                'success' => true,
                'message' => 'อัปเดตข้อมูล User สำเร็จ',
                'reload' => true,
            ];
        } else {
            $data['validation'] = $this->validator;
            $data = [
                'name_user'     => $this->request->getVar('name'),
                'lastname_user'     => $this->request->getVar('last'),
                'email_user'    => $this->request->getVar('email'),
                'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'group' => $this->request->getVar('group_select'),
                'role' => $this->request->getVar('role_select'),
                'status' => $this->request->getVar('activated'),
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

    public function edit_OwnUser($id_user = null)
    {
        $session = session();
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[2]|max_length[200]',
            'last'          => 'required|min_length[2]|max_length[200]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[user_table.email_user,id_user,'.$id_user.']',
        ];

        if ($this->validate($rules)) {
            $userModels = new UserModels();

            $activated = $this->request->getVar('activated');
            if ($activated == 'on') {
                $status = 1;
            } else {
                $status = 0;
            }
            $data = [
                'name_user'     => $this->request->getVar('name'),
                'lastname_user'     => $this->request->getVar('last'),
                'email_user'    => $this->request->getVar('email'),
                'group' => $this->request->getVar('group_select'),
                'status' => $status,
            ];
            $ses_data = [
                'id' => $id_user,
                'name' => $this->request->getVar('name'),
                'lastname' => $this->request->getVar('last'),
                'email' => $this->request->getVar('email'),
                'isLoggedIn' => TRUE
            ];
            $profile_picture = $this->request->getFile('profile_picture');
            if ($profile_picture->isValid() && !$profile_picture->hasMoved()) {
                $imageData = file_get_contents($profile_picture->getTempName()); // Read image file data
                $base64ImageData = base64_encode($imageData);
                $data['image_profile'] = $base64ImageData;
                $ses_data['profile_image'] = $base64ImageData;
            } else {
                $have_pictures = $this->request->getVar('have_pictures');
                if ($have_pictures == '0') {
                    $data['image_profile'] = null;
                    $ses_data['profile_image'] = null;
                }
            }

            $session->set($ses_data);
            $userModels->update($id_user, $data);
            $response = [
                'success' => true,
                'message' => 'อัปเดตข้อมูล User สำเร็จ',
                'reload' => true,
            ];
        } else {
            $data['validation'] = $this->validator;
            $data = [
                'name_user'     => $this->request->getVar('name'),
                'lastname_user'     => $this->request->getVar('last'),
                'email_user'    => $this->request->getVar('email'),
                'group' => $this->request->getVar('group_select'),
                'status' => $this->request->getVar('activated'),
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

    public function editpass_OwnUser($id_user = null)
    {
        helper(['form']);

        $userModels = new UserModels();

        $data = [
            'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];
        $userModels->update($id_user, $data);
        $response = [
            'success' => true,
            'message' => 'อัปเดตข้อมูล Password สำเร็จ',
            'reload' => true,
        ];
        
        return $this->response->setJSON($response);
    }
}
