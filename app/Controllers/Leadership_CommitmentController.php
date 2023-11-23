<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\AllversionModels;
use App\Models\Leadership_orgModels;
use App\Models\Leadership_ObjectiveModels;
use App\Models\TimelineModels;

class Leadership_CommitmentController extends BaseController
{
    public function index($id_version = null)
    {
        $Leadership_orgModels = new Leadership_orgModels();
        $data['org_data'] = $Leadership_orgModels->where('id_version', $id_version)->first();
        return $this->response->setJSON($data);
    }

    public function create_organizational_firsttime($id_version = null)
    {
        $Leadership_orgModels = new Leadership_orgModels();
        $data['org_data'] = $Leadership_orgModels->where('id_version', $id_version)->first();
        if (empty($data['org_data'])) {
            $data = [
                'id_version' => $id_version,
            ];
            $Leadership_orgModels->save($data);
        }
        return redirect()->to('leadership/commitment/index/' . $id_version);
    }
    public function edit_organizational($id_org = null)
    {
        helper(['form']);
        $data = [
            'text' => $this->request->getVar('Organizational'),
        ];
        $Leadership_orgModels = new Leadership_orgModels();
        $createdata = $Leadership_orgModels->update($id_org, $data);
        if ($createdata) {
            $response = [
                'success' => true,
                'message' => 'Save Organizational Strategy Successful!',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to update information!',
                'data' => $data
            ];
        }
        return $this->response->setJSON($response);
    }

    //----- Objective -----//
    public function is_objective_index($id_version = null, $num_ver = null)
    {
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 5)->first();
        $AllversionModels = new AllversionModels();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $data['data1'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Leadership/Commitment', $data);
    }

    public function is_objective_create($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Leadership_ObjectiveModels = new Leadership_ObjectiveModels();
        $TimelineModels = new TimelineModels();

        $text = $this->request->getVar('text');
        $data = [
            'text' => $text,
            'id_version' => $id_version,
        ];
        $createdata = $Leadership_ObjectiveModels->save($data);
        if ($createdata) {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create IS Objective',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Save IS Objective Successful!',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to update information!',
                'data' => $data
            ];
        }
        return $this->response->setJSON($response);
    }

    public function is_objective_edit($id_is_objective = null,$id_version = null, $status_version = null)
    {
        helper(['form']);

        $Leadership_ObjectiveModels = new Leadership_ObjectiveModels();
        $text = $this->request->getVar('text');
    
        $data = [
            'text' => $text,
        ];
    
        $updataData = $Leadership_ObjectiveModels->update($id_is_objective, $data);

        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Modified IS Objective',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
    
        $response = [
            'success' => $updataData,
            'message' => $updataData ? 'Update IS Objective Successful!' : 'Unable to update information!',
            'reload' => $updataData,
        ];
    
        return $this->response->setJSON($response);
    }
    
    public function is_objective_copy($id_is_objective = null)
    {
        helper(['form']);

        $Leadership_ObjectiveModels = new Leadership_ObjectiveModels();
    
        $copyData = $Leadership_ObjectiveModels->copyDataById($id_is_objective);
    
        $response = [
            'success' => $copyData,
            'message' => $copyData ? 'Copy IS Objective Successful!' : 'Unable to Copy information!',
            'reload' => $copyData,
        ];
    
        return $this->response->setJSON($response);
    }

    public function is_objective_delete($id_is_objective = null, $id_version = null, $status_version = null)
    {
        $Leadership_ObjectiveModels = new Leadership_ObjectiveModels();
    
        $deleteData = $Leadership_ObjectiveModels->where('id_is_objective', $id_is_objective)->delete($id_is_objective);
    
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete IS Objective',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);

        $response = [
            'success' => $deleteData,
            'message' => $deleteData ? 'Delete IS Objective Successful!' : 'Unable to Delete information!',
            'reload' => $deleteData,
        ];
    
        return $this->response->setJSON($response);
    }
    public function getdatatable_objective($id_version = null)
    {
        $Leadership_ObjectiveModels = new Leadership_ObjectiveModels();
        $totalRecords = $Leadership_ObjectiveModels->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $data = $Leadership_ObjectiveModels->where('id_version', $id_version)->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }


}