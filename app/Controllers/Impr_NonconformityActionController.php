<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\Audit_Report_Models;
use App\Models\Followup_Nonconformity_Models;
use App\Models\Followup_Observation_Models;
use App\Models\Followup_Opportunity_Models;

class Impr_NonconformityActionController extends BaseController
{
    public function index($id_version = null, $num_ver = null)
    {
        
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();
        $audit_reportmodel = new Audit_Report_Models();
        $data['audit_report'] = $audit_reportmodel->orderBy('id_audit_report', 'AES')->findAll();
        $followup_nonconformitymodel = new Followup_Nonconformity_Models();
        $data['followup_nonconformity'] = $followup_nonconformitymodel->orderBy('id_nonconformity', 'AES')->findAll();
        $followup_observationmodel = new Followup_Observation_Models();
        $data['followup_observation'] = $followup_observationmodel->orderBy('id_observation', 'AES')->findAll();
        $followup_opportunitymodel = new Followup_Opportunity_Models();
        $data['followup_opportunity'] = $followup_opportunitymodel->orderBy('id_opportunity', 'AES')->findAll();

        $data['data'] = [
            'id_version' => 1,
            'modified_date' => date('D/M/Y'),
            'review_date' => date('D/M/Y'),
            'approved_date' => date('D/M/Y'),
            'announce_date' => date('D/M/Y'),
            'status' => 3,
            'type_version' => 1,
            'num_ver' => 1,
        ];
        
        echo view('layout/header');
        echo view('Improvement/Impr_NonconformityAction', $data);
    }
    
    public function get_data_nonconformity_action_nonconformity()
    {
        $followup_nonconformitymodel = new Followup_Nonconformity_Models();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $followup_nonconformitymodel->groupStart()
                ->like('id_nonconformity', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $followup_nonconformitymodel->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $followup_nonconformitymodel->groupStart()
                ->like('id_nonconformity', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $data = $followup_nonconformitymodel->findAll($limit, $start);


        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }

    public function get_data_nonconformity_action_observation()
    {
        $followup_observationmodel = new Followup_Observation_Models();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $followup_observationmodel->groupStart()
                ->like('id_audit_result', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $followup_observationmodel->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $followup_observationmodel->groupStart()
                ->like('id_audit_result', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $data = $followup_observationmodel->findAll($limit, $start);


        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }

    public function get_data_nonconformity_action_opportunity()
    {
        $followup_opportunitymodel = new Followup_Opportunity_Models();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $followup_opportunitymodel->groupStart()
                ->like('id_audit_result', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $followup_opportunitymodel->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $followup_opportunitymodel->groupStart()
                ->like('id_audit_result', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $data = $followup_opportunitymodel->findAll($limit, $start);


        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }

}
