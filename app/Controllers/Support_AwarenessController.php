<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\AllversionModels;
use App\Models\TimelineModels;
use App\Models\FileModels;
use App\Models\Support_Awareness;

class Support_AwarenessController extends BaseController
{
    //-- index Competence --//
    public function index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 13)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Support/Awareness', $data);
    }
}
