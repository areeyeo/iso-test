<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\ISMS_ScopeModels;
use App\Models\FileModels;
use App\Models\RequirementModels;

use App\Models\TimelineModels;

class ISMS_ScopeController extends BaseController
{

    public function isms_scope_index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();

        $RequirementModels = new RequirementModels();
        $scopemodel = new ISMS_ScopeModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 3)->first();

        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data
        $data['data_scope'] = $scopemodel->where('id_version', $id_version)->orderBy('id_scope ', 'AES')->findAll();


        echo view('layout/header');
        echo view('Context/isms_scope', $data);
    }

    public function store($id_version = null, $status_version = null)
    {
        helper(['form']);
        $TimelineModels = new TimelineModels();
        $scopemodel = new ISMS_ScopeModels();

        $data = [
            'location' => $this->request->getVar('location'),
            'organization' => $this->request->getVar('organization'),
            'system_service' => $this->request->getVar('system_service'),
            'scope_statement' => $this->request->getVar('scope_statement'),
            'id_version' => $id_version,
        ];
        $check = $scopemodel->save($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Scope!',
            ];
        } else {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Scope',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully created Scope',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function edit($id_version = null, $status_version = null, $id_scope = null)
    {
        helper(['form']);
        $TimelineModels = new TimelineModels();
        $scopemodel = new ISMS_ScopeModels();

        $data = [
            'location' => $this->request->getVar('location'),
            'organization' => $this->request->getVar('organization'),
            'system_service' => $this->request->getVar('system_service'),
            'scope_statement' => $this->request->getVar('scope_statement'),
        ];
        $check = $scopemodel->update($id_scope, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Scope data cannot be edited.',
            ];
        } else {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Modified Scope',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Scope data edited successfully!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function get_scope_table($id = null)
    {

        $scopemodel = new ISMS_ScopeModels();
        $data = $scopemodel->where('id_scope', $id)->first();
        echo json_encode($data);
    }
}