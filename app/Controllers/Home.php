<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\RequirementModels;

class Home extends BaseController
{
    public function index()
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->findAll();
        $totalRecordsDraft = $AllversionModels->where('status', 0)->countAllResults();
        $totalRecordsPendingR = $AllversionModels->where('status', 1)->countAllResults();
        $totalRecordsReview = $AllversionModels->where('status', 2)->countAllResults();
        $totalRecordsPendingA = $AllversionModels->where('status', 3)->countAllResults();
        $totalRecordsApprove = $AllversionModels->where('status', 4)->countAllResults();
        $totalRecordsReject = $AllversionModels->where('status', 5)->countAllResults();
        $data['data'] = [
            'totalDrafts' => $totalRecordsDraft,
            'totalPendingR' => $totalRecordsPendingR,
            'totalReview' => $totalRecordsReview,
            'totalPendingA' => $totalRecordsPendingA,
            'totalApproval' => $totalRecordsApprove,
            'totalReject' => $totalRecordsReject,
        ];
        echo view('layout/header');
        echo view('dashboard', $data);
    }


}