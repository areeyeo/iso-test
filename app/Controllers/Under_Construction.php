<?php

namespace App\Controllers;

class Under_Construction extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('under_construction');
    }


}