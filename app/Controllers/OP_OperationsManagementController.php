<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\Address_Risk_Context_Models;
use App\Models\Address_Risk_IS_Models;
use App\Models\Planning_is_planningModels;
use App\Models\Planning_is_objectivesModels;
use App\Models\Planning_of_changesModels;
use App\Models\AllversionModels;

class OP_OperationsManagementController extends BaseController
{
    //-- Public Methods --//
    public function __construct()
    {
        helper(['url', 'form']);
    }

    //-- index operations management --//
    public function index_operations_management()
    {
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();

        echo view('layout/header');
        echo view('Operation/OP_Operations_Management', $data);
    }

    //-- get data Risk Context --//
    public function get_data_risk_context()
    {
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        $version = $this->getLastVersion(15);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Address_Risk_Context_Models->groupStart()
                ->like('name_of_risk_treatment_plan', $searchValue)
                ->orLike('rtp_no', $searchValue)
                ->groupEnd();
        }

        $totalRecords = $Address_Risk_Context_Models->where('id_version', $version)->where('rtp_no IS NOT NULL', null, false)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Address_Risk_Context_Models->groupStart()
                ->like('name_of_risk_treatment_plan', $searchValue)
                ->orLike('rtp_no', $searchValue)
                ->groupEnd();
        }
        $data = $Address_Risk_Context_Models->where('id_version', $version)->where('rtp_no IS NOT NULL', null, false)->findAll($limit, $start);
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }
    //-- edit data Risk Context --//
    public function operation_edit_risk_context($id_address_risks_context = null)
    {
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        $data = [
            'rtp_no' => $this->request->getVar('rtp_context_no'),
            'name_of_risk_treatment_plan' => $this->request->getVar('planning_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'risk_ownner' => $this->request->getVar('owner'),
            'status' => $this->request->getVar('status'),
            'evaluation' => $this->request->getVar('evaluation'),
            'result' => $this->request->getVar('result'),
        ];
        $Address_Risk_Context_Models->update($id_address_risks_context, $data);
        $response = [
            'success' => true,
            'message' => 'Operations Management Risk Context edited successfully!',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //-- get data Risk IS --//
    public function get_data_risk_is()
    {
        $Address_Risk_IS_Models = new Address_Risk_IS_Models();
        $version = $this->getLastVersion(16);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Address_Risk_IS_Models->groupStart()
                ->like('name_of_risk_treatment_plan', $searchValue)
                ->orLike('rtp_no', $searchValue)
                ->groupEnd();
        }

        $totalRecords = $Address_Risk_IS_Models->where('id_version', $version)->where('rtp_no IS NOT NULL', null, false)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Address_Risk_IS_Models->groupStart()
                ->like('name_of_risk_treatment_plan', $searchValue)
                ->orLike('rtp_no', $searchValue)
                ->groupEnd();
        }
        $data = $Address_Risk_IS_Models->where('id_version', $version)->where('rtp_no IS NOT NULL', null, false)->findAll($limit, $start);
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }
    //-- edit data Risk IS --//
    public function operation_edit_risk_is($id_address_risks_is = null)
    {
        $Address_Risk_IS_Models = new Address_Risk_IS_Models();
        $data = [
            'rtp_no' => $this->request->getVar('rtp_is_no'),
            'name_of_risk_treatment_plan' => $this->request->getVar('planning_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'risk_ownner' => $this->request->getVar('owner'),
            'status' => $this->request->getVar('status'),
            'evaluation' => $this->request->getVar('evaluation'),
            'result' => $this->request->getVar('result'),
        ];
        $Address_Risk_IS_Models->update($id_address_risks_is, $data);
        $response = [
            'success' => true,
            'message' => 'Operations Management Risk IS edited successfully!',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //-- get data IS Objectives --//
    public function get_data_is_objectives()
    {
        $Planning_is_planningModels = new Planning_is_planningModels();
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();

        $version = $this->getLastVersion(10);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        // Joining the tables
        $Planning_is_planningModels->join('planning_is_objectives_objectives_table', 'planning_is_objectives_planning_table.id_objective = planning_is_objectives_objectives_table.id_objective', 'left');

        if (!empty($searchValue)) {
            $Planning_is_planningModels->groupStart()
                ->like('planning_is_objectives_planning_table.planning', $searchValue)
                ->orLike('planning_is_objectives_objectives_table.obj_no', $searchValue)
                ->groupEnd();
        }

        // Count total records
        $totalRecords = $Planning_is_planningModels->where('planning_is_objectives_planning_table.id_version', $version)->countAllResults();
        $recordsFiltered = $totalRecords;

        $Planning_is_planningModels->join('planning_is_objectives_objectives_table', 'planning_is_objectives_planning_table.id_objective = planning_is_objectives_objectives_table.id_objective', 'left');

        if (!empty($searchValue)) {
            $Planning_is_planningModels->groupStart()
                ->like('planning_is_objectives_planning_table.planning', $searchValue)
                ->orLike('planning_is_objectives_objectives_table.obj_no', $searchValue)
                ->groupEnd();
        }

        // Get paginated results
        $data = $Planning_is_planningModels->where('planning_is_objectives_planning_table.id_version', $version)->findAll($limit, $start);

        // Fetch associated objectives data for each record
        foreach ($data as $key => $value) {
            $data[$key]['objectives'] = $Planning_is_objectivesModels->where('id_objective', $value['id_objective'])->first();
        }

        // Prepare response
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }

    //-- edit data IS Objectives --//
    public function operation_edit_is_objectives($id_planning  = null, $id_objective = null)
    {
        $Planning_is_planningModels = new Planning_is_planningModels();
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $data = [
            'planning' => $this->request->getVar('planning_name'),
            'start_date' => $this->request->getVar('start_date_is_objective'),
            'end_date' => $this->request->getVar('end_date_is_objective'),
            'owner' => $this->request->getVar('owner'),
            'status' => $this->request->getVar('status'),
            'result' => $this->request->getVar('result'),
        ];
        $Planning_is_planningModels->update($id_planning, $data);

        $data_objective = [
            'obj_no' => $this->request->getVar('obj_no'),
            'evaluation' => $this->request->getVar('evaluation'),
        ];
        $Planning_is_objectivesModels->update($id_objective, $data_objective);

        $response = [
            'success' => true,
            'message' => 'Operations Management IS Objective edited successfully!',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //-- get data Planning of Change --//
    public function get_data_planning_change()
    {
        $Planning_of_changesModels = new Planning_of_changesModels();
        $version = $this->getLastVersion(11);
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Planning_of_changesModels->groupStart()
                ->like('name_planing_change', $searchValue)
                ->orLike('pl_no', $searchValue)
                ->groupEnd();
        }

        $totalRecords = $Planning_of_changesModels->where('id_version', $version)->where('pl_no IS NOT NULL', null, false)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Planning_of_changesModels->groupStart()
                ->like('name_planing_change', $searchValue)
                ->orLike('pl_no', $searchValue)
                ->groupEnd();
        }
        $data = $Planning_of_changesModels->where('id_version', $version)->where('pl_no IS NOT NULL', null, false)->findAll($limit, $start);
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }
    //-- edit data Planning of Change --//
    public function operation_edit_planning_change($id_planning_changes = null)
    {
        $Planning_of_changesModels = new Planning_of_changesModels();
        $data = [
            'pl_no' => $this->request->getVar('pl_no'),
            'name_planing_change' => $this->request->getVar('planning_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'owner' => $this->request->getVar('owner'),
            'status' => $this->request->getVar('status'),
            'evaluation' => $this->request->getVar('evaluation'),
            'result' => $this->request->getVar('result'),
        ];
        $Planning_of_changesModels->update($id_planning_changes, $data);
        $response = [
            'success' => true,
            'message' => 'Operations Management Planning of Change edited successfully!',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //find last version of type
    public function getLastVersion($type = null)
    {
        $AllversionModels = new AllversionModels();
        $version = $AllversionModels->where('type_version', $type)->orderBy('id_version', 'desc')->select('id_version')->first();
        return $version['id_version'];
    }
}
