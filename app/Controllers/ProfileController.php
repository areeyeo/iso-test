<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModels;
use App\Models\GroupModels;
use App\Models\RoleModels;
use App\Models\AllversionModels;

class ProfileController extends BaseController
{
    public function index()
    {
        $usermodel = new UserModels();
        $data['users'] = $usermodel->where('id_user', session()->get('id'))->first();
        $groupmodel = new GroupModels();
        $data['groups'] = $groupmodel->orderBy('id_group', 'AES')->findAll();
        $rolemodel = new RoleModels();
        $data['roles'] = $rolemodel->orderBy('id_role', 'AES')->findAll();
        $AllversionModels = new AllversionModels();
        $data['data'] = $AllversionModels->where('id_user', session()->get('id'))->findAll();
        echo view('layout/header');
        echo view('profile', $data);
    }
}
