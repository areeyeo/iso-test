<?php

namespace App\Controllers;

use App\Models\UserModels;
use App\Models\RoleModels;
use App\Models\ActivitesLogModels;

class LoginController extends BaseController
{
    public function index()
    {
        echo view('login');
    }

    public function loginAuth()
    {
        helper(['form']);

        $session = session();
        $UserModels = new UserModels();
        $RoleModels = new RoleModels();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $UserModels->where('email_user', $email)->first();
        if ($data) {
            if ($data['status'] == 0) {
                $response = [
                    'success' => false,
                    'message' => 'User นี้ถูกปิดใช้งาน',
                    'reload' => false,
                ];
            } else {
                $pass = $data['password_user'];
                $authenticatePassword = password_verify($password, $pass);
                if ($authenticatePassword) {

                    $role = $RoleModels->where('id_role', $data['role'])->first();

                    $ses_data = [
                        'id' => $data['id_user'],
                        'name' => $data['name_user'],
                        'lastname' => $data['lastname_user'],
                        'email' => $data['email_user'],
                        'role' => $role['name_role'],
                        'isLoggedIn' => TRUE
                    ];
                    if ($data['image_profile'] == null) {
                        $ses_data['profile_image'] = null;
                    } else {
                        $ses_data['profile_image'] = $data['image_profile'];
                    }
                    $session->set($ses_data);
                    $response = [
                        'success' => true,
                        'message' => 'เข้าสู่ระบบสำเร็จ',
                        'reload' => false,
                    ];

                    $activitesLogModel = new ActivitesLogModels();
                    $data_log = [
                        'text_activities' => session()->get('name') . ' ' . session()->get('lastname') . ' ได้เข้าสู่ระบบ ',
                        'type_activities' => 4,
                        'id_user'    => session()->get('id'),
                    ];

                    $activitesLogModel->save($data_log);
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'รหัสผ่านไม่ถูกต้อง',
                        'reload' => false,
                        'email' => $this->request->getVar('email'),
                        'password' => $this->request->getVar('password'),
                    ];
                }
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'ไม่พบอีเมล์ที่ลงทะเบียนไว้',
                'reload' => false,
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];
        }
        return $this->response->setJSON($response);
    }

    public function logout()
    {
        $activitesLogModel = new ActivitesLogModels();
        $data_log = [
            'text_activities' => session()->get('name') . ' ' . session()->get('lastname') . ' ได้ออกจากระบบ ',
            'type_activities' => 5,
            'id_user'    => session()->get('id'),
        ];

        $activitesLogModel->save($data_log);

        $session = session();
        $session->destroy();

        return redirect()->to('/login');
    }
}
