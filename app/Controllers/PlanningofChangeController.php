<?php

namespace App\Controllers;

class PlanningofChangeController extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('Planning/PlanningofChange');
    }

}
