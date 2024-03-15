<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\AllversionModels;
use App\Models\Consequence_level_context_Models;
use App\Models\Consequence_level_item_context_Models;
use App\Models\Likelihood_level_context_Models;
use App\Models\Risk_level_context_Models;
use App\Models\Risk_options_context_Models;
use App\Models\InternalModels;
use App\Models\ExternalModels;
use App\Models\InterestedModels;
use App\Models\Internal_issuesModels;
use App\Models\External_issuesModels;
use App\Models\Interested_issuesModels;
use App\Models\TimelineModels;
use App\Models\Impact_level_context_Models;
use App\Models\FileModels;
use App\Models\Address_Risk_Context_Models;
use App\Models\Address_Risk_Opp_Context_Data_Models;
use App\Models\Address_Risk_Opp_Context_Models;

class Planning_AddressRisksOppController extends BaseController
{
    public function index_context($id_version = null, $num_ver = null)
    {
        $RequirementModels = new RequirementModels();
        $AllversionModels = new AllversionModels();
        $Risk_level_context_Models = new Risk_level_context_Models();
        $data['Risk_level_context'] = $Risk_level_context_Models->findAll();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 8)->first();
        $data['data_context'] = $AllversionModels->where('id_version', $id_version)->first();
        $data['data_is'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data_context'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Planning/PlanningAddressRisksOpp_context', $data);
    }

    public function index_is($id_version = null, $num_ver = null)
    {
        $RequirementModels = new RequirementModels();
        $AllversionModels = new AllversionModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 8)->first();

        $data['data'] = [
            'id_version' => 1,
            'modified_date' => date('D/M/Y'),
            'review_date' => date('D/M/Y'),
            'approved_date' => date('D/M/Y'),
            'announce_date' => date('D/M/Y'),
            'status' => 1,
            'type_version' => 1,
            'num_ver' => 1,
        ];


        echo view('layout/header');
        echo view('Planning/PlanningAddressRisksOpp_is', $data);
    }


    // index Create Context Risk & Opportunities
    public function indexCrudContext($id_version = null, $num_ver = null)
    {
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();
        $Likelihood_level_context_Models = new Likelihood_level_context_Models();
        $Risk_level_context_Models = new Risk_level_context_Models();
        $Risk_options_context_Models = new Risk_options_context_Models();
        $InternalModels = new InternalModels();
        $ExternalModels = new ExternalModels();
        $InterestedModels = new InterestedModels();
        $Internal_issuesModels = new Internal_issuesModels();
        $External_issuesModels = new External_issuesModels();
        $Interested_issuesModels = new Interested_issuesModels();
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 8)->first();

        $data['risk_options'] = $Risk_options_context_Models->findAll();
        $data['Likelihood_level_context'] = $Likelihood_level_context_Models->findAll();
        $data['Risk_level_context'] = $Risk_level_context_Models->findAll();
        $data['consequence_level_context'] = $Consequence_level_context_Models->where('status', 1)->findAll();

        $all_version_internal_external = $AllversionModels
            ->where('type_version', 1)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_internal_external)) {
            $data['internal_data'] = $InternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_internal, id_internal_issues')->findAll();
            foreach ($data['internal_data'] as $key => $value) {
                $data['internal_data'][$key]['internal_issues'] = $Internal_issuesModels->where('id_internal_issues', $value['id_internal_issues'])->select('topic')->first();
            }
            $data['external_data'] = $ExternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_external, id_external_issues')->findAll();
            foreach ($data['external_data'] as $key => $value) {
                $data['external_data'][$key]['external_issues'] = $External_issuesModels->where('id_external_issues', $value['id_external_issues'])->select('topic')->first();
            }
        } else {
            $data['internal_data'] = null;
            $data['external_data'] = null;
        }

        $all_version_interested = $AllversionModels
            ->where('type_version', 2)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_interested)) {
            $data['interested_data'] = $InterestedModels->where('id_version', $all_version_interested['id_version'])->findAll();
            foreach ($data['interested_data'] as $key => $value) {
                $data['interested_data'][$key]['interested_issues'] = $Interested_issuesModels->where('id_interested_issues', $value['id_interested_issues'])->select('topic')->first();
            }
        } else {
            $data['interested_data'] = null;
        }

        foreach ($data['consequence_level_context'] as $key => $item) {
            $data_item = $Consequence_level_item_context_Models->where('id_consequence_level', $item['id_consequence_level_context'])->findAll();
            // Append the new data to the existing array
            $data['consequence_level_context'][$key]['data_item'] = $data_item;
        }
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data
        $data['data_risk'] = null;
        $data['data_opportunity'] = null;
        $data['viewMode'] = false;
        echo view('layout/header');
        echo view('Planning/CRUD_RiskOppContext', $data);
    }

    // index Edit Context Risk
    public function indexEditContext_risk($id_version = null, $num_ver = null, $id_address_risks_context = null)
    {
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();
        $Likelihood_level_context_Models = new Likelihood_level_context_Models();
        $Risk_level_context_Models = new Risk_level_context_Models();
        $Risk_options_context_Models = new Risk_options_context_Models();
        $InternalModels = new InternalModels();
        $ExternalModels = new ExternalModels();
        $InterestedModels = new InterestedModels();
        $Internal_issuesModels = new Internal_issuesModels();
        $External_issuesModels = new External_issuesModels();
        $Interested_issuesModels = new Interested_issuesModels();
        $AllversionModels = new AllversionModels();
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 8)->first();
        $data['risk_options'] = $Risk_options_context_Models->findAll();
        $data['Likelihood_level_context'] = $Likelihood_level_context_Models->findAll();
        $data['Risk_level_context'] = $Risk_level_context_Models->findAll();
        $data['consequence_level_context'] = $Consequence_level_context_Models->where('status', 1)->findAll();

        $all_version_internal_external = $AllversionModels
            ->where('type_version', 1)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_internal_external)) {
            $data['internal_data'] = $InternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_internal, id_internal_issues')->findAll();
            foreach ($data['internal_data'] as $key => $value) {
                $data['internal_data'][$key]['internal_issues'] = $Internal_issuesModels->where('id_internal_issues', $value['id_internal_issues'])->select('topic')->first();
            }
            $data['external_data'] = $ExternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_external, id_external_issues')->findAll();
            foreach ($data['external_data'] as $key => $value) {
                $data['external_data'][$key]['external_issues'] = $External_issuesModels->where('id_external_issues', $value['id_external_issues'])->select('topic')->first();
            }
        } else {
            $data['internal_data'] = null;
            $data['external_data'] = null;
        }

        $all_version_interested = $AllversionModels
            ->where('type_version', 2)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_interested)) {
            $data['interested_data'] = $InterestedModels->where('id_version', $all_version_interested['id_version'])->findAll();
            foreach ($data['interested_data'] as $key => $value) {
                $data['interested_data'][$key]['interested_issues'] = $Interested_issuesModels->where('id_interested_issues', $value['id_interested_issues'])->select('topic')->first();
            }
        } else {
            $data['interested_data'] = null;
        }

        foreach ($data['consequence_level_context'] as $key => $item) {
            $data_item = $Consequence_level_item_context_Models->where('id_consequence_level', $item['id_consequence_level_context'])->findAll();
            // Append the new data to the existing array
            $data['consequence_level_context'][$key]['data_item'] = $data_item;
        }
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data
        $data['data_risk'] = $Address_Risk_Context_Models->where('id_address_risks_context', $id_address_risks_context)->first();
        $data['data_opportunity'] = null;
        $data['viewMode'] = false;
        echo view('layout/header');
        echo view('Planning/CRUD_RiskOppContext', $data);
    }

    // index View Context Risk
    public function indexViewContext_risk($id_version = null, $num_ver = null, $id_address_risks_context = null)
    {
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Consequence_level_item_context_Models = new Consequence_level_item_context_Models();
        $Likelihood_level_context_Models = new Likelihood_level_context_Models();
        $Risk_level_context_Models = new Risk_level_context_Models();
        $Risk_options_context_Models = new Risk_options_context_Models();
        $InternalModels = new InternalModels();
        $ExternalModels = new ExternalModels();
        $InterestedModels = new InterestedModels();
        $Internal_issuesModels = new Internal_issuesModels();
        $External_issuesModels = new External_issuesModels();
        $Interested_issuesModels = new Interested_issuesModels();
        $AllversionModels = new AllversionModels();
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 8)->first();
        $data['risk_options'] = $Risk_options_context_Models->findAll();
        $data['Likelihood_level_context'] = $Likelihood_level_context_Models->findAll();
        $data['Risk_level_context'] = $Risk_level_context_Models->findAll();
        $data['consequence_level_context'] = $Consequence_level_context_Models->where('status', 1)->findAll();

        $all_version_internal_external = $AllversionModels
            ->where('type_version', 1)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_internal_external)) {
            $data['internal_data'] = $InternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_internal, id_internal_issues')->findAll();
            foreach ($data['internal_data'] as $key => $value) {
                $data['internal_data'][$key]['internal_issues'] = $Internal_issuesModels->where('id_internal_issues', $value['id_internal_issues'])->select('topic')->first();
            }
            $data['external_data'] = $ExternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_external, id_external_issues')->findAll();
            foreach ($data['external_data'] as $key => $value) {
                $data['external_data'][$key]['external_issues'] = $External_issuesModels->where('id_external_issues', $value['id_external_issues'])->select('topic')->first();
            }
        } else {
            $data['internal_data'] = null;
            $data['external_data'] = null;
        }

        $all_version_interested = $AllversionModels
            ->where('type_version', 2)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_interested)) {
            $data['interested_data'] = $InterestedModels->where('id_version', $all_version_interested['id_version'])->findAll();
            foreach ($data['interested_data'] as $key => $value) {
                $data['interested_data'][$key]['interested_issues'] = $Interested_issuesModels->where('id_interested_issues', $value['id_interested_issues'])->select('topic')->first();
            }
        } else {
            $data['interested_data'] = null;
        }

        foreach ($data['consequence_level_context'] as $key => $item) {
            $data_item = $Consequence_level_item_context_Models->where('id_consequence_level', $item['id_consequence_level_context'])->findAll();
            // Append the new data to the existing array
            $data['consequence_level_context'][$key]['data_item'] = $data_item;
        }
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data
        $data['data_risk'] = $Address_Risk_Context_Models->where('id_address_risks_context', $id_address_risks_context)->first();
        $data['data_opportunity'] = null;
        $data['viewMode'] = true;
        echo view('layout/header');
        echo view('Planning/CRUD_RiskOppContext', $data);
    }

    //create context Risk
    public function createContext_risk($id_version = null, $status_version = null, $check_over_risk = null)
    {
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        $FileModels = new FileModels();
        helper(['form']);

        $issue = $this->request->getVar('issue');
        $likelihood = $this->request->getVar('likelihood');
        $risklevel = $this->request->getVar('risklevel');

        if (empty($issue)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please select issue', 'reload' => false]);
        }

        $value_operational_consequences = [];
        $number_consequence = $Consequence_level_context_Models->where('status', 1)->countAllResults();

        for ($i = 0; $i < $number_consequence; $i++) {
            $name_operational_consequences = 'operational_' . $i;
            $value_operational_consequences[$i] = $this->request->getVar($name_operational_consequences);

            if ($value_operational_consequences[$i] == '0') {
                return $this->response->setJSON(['success' => false, 'message' => 'Please select all Consequences.', 'reload' => false]);
            }
        }

        if (empty($likelihood)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please select likelihood', 'reload' => false]);
        }
        if (empty($risklevel)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please fill out all parts of the information completely.', 'reload' => false]);
        }

        $risk_options = null;
        $risk_treatment_plan = null;
        $risk_ownner = null;
        $start_date = null;
        $end_date = null;
        $rtp_status = 'ดำเนินการเสร็จสิ้น';
        $id_file = null;
        $consequence_after = [];
        $consequence_after_str = null;
        $likelihood_after = null;
        $residual = null;
        $rtp_no = null;
        if ($check_over_risk == 1) {
            $risk_options = $this->request->getVar('risk-option');
            if ($risk_options == 0) {
                return $this->response->setJSON(['success' => false, 'message' => 'Please select risk options.', 'reload' => false]);
            }
            $risk_treatment_plan = $this->request->getVar('risk_treatmentplan');
            $risk_ownner = $this->request->getVar('risk_owner');
            $start_date = $this->request->getVar('startdate_context');
            $end_date = $this->request->getVar('enddate_context');

            for ($i = 0; $i < $number_consequence; $i++) {
                $name_operational_consequences_after = 'operational_after_' . $i;
                $consequence_after[$i] = $this->request->getVar($name_operational_consequences_after);

                if ($consequence_after[$i] == 0) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Please select all Consequences.', 'reload' => false]);
                }
            }
            $consequence_after_str = implode(',', $consequence_after);

            $likelihood_after = $this->request->getVar('likelihood2');
            if (empty($likelihood_after)) {
                return $this->response->setJSON(['success' => false, 'message' => 'Please select likelihood', 'reload' => false]);
            }
            $residual = $this->request->getVar('residual');
            $rtp_status = 'รอดำเนินการ';

            $file = $this->request->getFile('risk_file');
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getClientName();
                $FileModels->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $FileModels->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
            }
            $num_rtp_no = $Address_Risk_Context_Models->where('id_version', $id_version)->where('risk_ownner IS NOT NULL')->countAllResults();
            $rtp_no = sprintf("RTP_CONTEXT_%03d", $num_rtp_no + 1);
        }
        $consequence_str = implode(',', $value_operational_consequences);

        $data = [
            'issue' => $issue,
            'consequence' => $consequence_str,
            'likelihood' => $likelihood,
            'risk_level' => $risklevel,
            'risk_assessment_level' => $this->request->getVar('risk_assessment_level_max'),
            'risk_options' => $risk_options,
            'risk_treatment_plan' => $risk_treatment_plan,
            'risk_ownner' => $risk_ownner,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'approve' => null,
            'rtp_status' => $rtp_status,
            'file' => $id_file,
            'consequence_after' => $consequence_after_str,
            'likelihood_after' => $likelihood_after,
            'residual' => $residual,
            'rtp_no' => $rtp_no,
            'id_version' => $id_version,
        ];

        $check_insert = $Address_Risk_Context_Models->insert($data);
        if ($check_insert) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Created Address Risk',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Created Address Risk',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error to create Address Risk',
                'reload' => false,
            ];
        }


        return $this->response->setJSON($response);
    }

    //edit data context Risk
    public function editContext_risk($id_version = null, $status_version = null, $check_over_risk = null, $id_address_risks_context = null)
    {
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        $FileModels = new FileModels();
        helper(['form']);
        helper('filesystem');

        $issue = $this->request->getVar('issue');
        $likelihood = $this->request->getVar('likelihood');
        $risklevel = $this->request->getVar('risklevel');

        if (empty($issue)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please select issue', 'reload' => false]);
        }

        $value_operational_consequences = [];
        $number_consequence = $Consequence_level_context_Models->where('status', 1)->countAllResults();

        for ($i = 0; $i < $number_consequence; $i++) {
            $name_operational_consequences = 'operational_' . $i;
            $value_operational_consequences[$i] = $this->request->getVar($name_operational_consequences);

            if ($value_operational_consequences[$i] == '0') {
                return $this->response->setJSON(['success' => false, 'message' => 'Please select all Consequences.', 'reload' => false]);
            }
        }

        if (empty($likelihood)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please select likelihood', 'reload' => false]);
        }
        if (empty($risklevel)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please fill out all parts of the information completely.', 'reload' => false]);
        }

        $risk_options = null;
        $risk_treatment_plan = null;
        $risk_ownner = null;
        $start_date = null;
        $end_date = null;
        $rtp_status = 'ดำเนินการเสร็จสิ้น';
        $consequence_after = [];
        $consequence_after_str = null;
        $likelihood_after = null;
        $residual = null;
        if ($check_over_risk == 1) {
            $risk_options = $this->request->getVar('risk-option');
            if ($risk_options == 0) {
                return $this->response->setJSON(['success' => false, 'message' => 'Please select risk options.', 'reload' => false]);
            }
            $risk_treatment_plan = $this->request->getVar('risk_treatmentplan');
            $risk_ownner = $this->request->getVar('risk_owner');
            $start_date = $this->request->getVar('startdate_context');
            $end_date = $this->request->getVar('enddate_context');

            for ($i = 0; $i < $number_consequence; $i++) {
                $name_operational_consequences_after = 'operational_after_' . $i;
                $consequence_after[$i] = $this->request->getVar($name_operational_consequences_after);

                if ($consequence_after[$i] == 0) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Please select all Consequences.', 'reload' => false]);
                }
            }
            $consequence_after_str = implode(',', $consequence_after);

            $likelihood_after = $this->request->getVar('likelihood2');
            $residual = $this->request->getVar('residual');
            $rtp_status = 'รอดำเนินการ';

            $file = $this->request->getFile('risk_file');
            if ($file !== null && $file->isValid()) {
                $newName = $file->getClientName();
                $check_file = $Address_Risk_Context_Models->where('id_address_risks_context', $id_address_risks_context)->findAll();
                if ($check_file[0]['file']) {
                    $del_path = 'public/uploads/' . $check_file[0]['file'] . '/'; // For Delete folder
                    $check_de_file = delete_files($del_path, false); // Delete files into the folder
                    if (!$check_de_file) {
                        $response = [
                            'success' => false,
                            'message' => 'Unable to add new files!',
                        ];
                        return $this->response->setJSON($response);
                    } else {
                        $file->move(ROOTPATH . 'public/uploads/' . $check_file[0]['file'], $newName);
                        $file_update = [
                            'name_file' => $newName,
                        ];
                        $FileModels->update($check_file[0]['file'], $file_update);
                    }
                } else {
                    $FileModels->insert([
                        'name_file' => $newName,
                    ]);
                    $id_file = $FileModels->insertID();
                    $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                    $data__ = [
                        'file' => $id_file,
                    ];
                    $Address_Risk_Context_Models->update($id_address_risks_context, $data__);
                }
            }
        } else {
            $check_file = $Address_Risk_Context_Models->where('id_address_risks_context', $id_address_risks_context)->findAll();
            if ($check_file[0]['file'] != null) {
                $FileModels->where('id_files ', $check_file[0]['file'])->delete($check_file[0]['file']);
                $del_path = 'public/uploads/' . $check_file[0]['file'] . '/'; // For Delete folder
                delete_files($del_path, true); // Delete files into the folder
                rmdir($del_path);
                $data__ = [
                    'file' => null,
                ];
                $Address_Risk_Context_Models->update($id_address_risks_context, $data__);
            }
        }
        $consequence_str = implode(',', $value_operational_consequences);

        $data = [
            'issue' => $issue,
            'consequence' => $consequence_str,
            'likelihood' => $likelihood,
            'risk_level' => $risklevel,
            'risk_assessment_level' => $this->request->getVar('risk_assessment_level_max'),
            'risk_options' => $risk_options,
            'risk_treatment_plan' => $risk_treatment_plan,
            'risk_ownner' => $risk_ownner,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'approve' => null,
            'rtp_status' => $rtp_status,
            'consequence_after' => $consequence_after_str,
            'likelihood_after' => $likelihood_after,
            'residual' => $residual,
            'id_version' => $id_version,
        ];

        $check_insert = $Address_Risk_Context_Models->update($id_address_risks_context, $data);
        if ($check_insert) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Address Risk',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Edit Address Risk',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error to Edit Address Risk',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }
    //delete data context Risk
    public function deleteContext_risk($id_address_risks_context = null, $No = null, $id_version = null, $status_version = null)
    {
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        helper('filesystem');
        $data = $Address_Risk_Context_Models->where('id_address_risks_context', $id_address_risks_context)->first();
        if ($data['file'] != null) {
            $filemodel = new FileModels();
            $filemodel->where('id_files ', $data['file'])->delete($data['file']);
            $del_path = 'public/uploads/' . $data['file'] . '/'; // For Delete folder

            $check1 = delete_files($del_path, true); // Delete files into the folder
            $check2 = rmdir($del_path);
            if (!$check1) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete Address Risks file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Address Risks!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $Address_Risk_Context_Models->where('id_address_risks_context', $id_address_risks_context)->delete($id_address_risks_context);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Address Risks No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Address Risks',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Address Risks No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //get data context Risk
    public function getContext_data_risk($id_version = null)
    {
        $Address_Risk_Context_Models = new Address_Risk_Context_Models();
        $Consequence_level_context_Models = new Consequence_level_context_Models();
        $Risk_options_context_Models = new Risk_options_context_Models();
        $FileModels = new FileModels();
        $totalRecords = $Address_Risk_Context_Models->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Address_Risk_Context_Models->groupStart()
                ->like('issue', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                // ->orLike('effect', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $select_Content = $this->request->getVar('select_Content');
        if ($select_Content == 0) {
            $data = $Address_Risk_Context_Models->where('id_version', $id_version)->findAll($limit, $start);
        } else if ($select_Content == 1) {
            $data = $Address_Risk_Context_Models->where('id_version', $id_version)->where('rtp_status', 'รอดำเนินการ')->findAll($limit, $start);
        } else if ($select_Content == 2) {
            $data = $Address_Risk_Context_Models->where('id_version', $id_version)->where('risk_options', null)->findAll($limit, $start);
        } else if ($select_Content == 3) {
            $data = $Address_Risk_Context_Models->where('id_version', $id_version)->where('rtp_status', 'กำลังดําเนินการ')->findAll($limit, $start);
        } else if ($select_Content == 4) {
            $data = $Address_Risk_Context_Models->where('id_version', $id_version)->where('rtp_status', 'ดำเนินการเสร็จสิ้น')->findAll($limit, $start);
        }

        foreach ($data as $key => $value) {
            $consequence = explode(',', $value['consequence']);
            foreach ($consequence as $consequence_key => $consequence_value) {
                $id_consequence = explode('-', $consequence_value);
                $data[$key]['consequence_data'][$consequence_key] = $Consequence_level_context_Models->where('id_consequence_level_context', $id_consequence[0])->first();
            }

            if ($value['risk_options'] != null) {
                $risk_options = $Risk_options_context_Models->where('id_risk_options_context', $value['risk_options'])->select('options')->first();
                $data[$key]['risk_options'] = $risk_options['options'];
            }

            if ($value['consequence_after'] != null) {
                $consequence_after = explode(',', $value['consequence_after']);
                foreach ($consequence_after as $consequence_after_key => $consequence_after_value) {
                    $id_consequence_after = explode('-', $consequence_after_value);
                    $data[$key]['consequence_after_data'][$consequence_after_key] = $Consequence_level_context_Models->where('id_consequence_level_context', $id_consequence_after[0])->first();
                }
            }

            if ($value['file'] != null) {
                $file = $FileModels->where('id_files', $value['file'])->first();
                $data[$key]['file'] = $file;
            }
        }

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }


    //create context opportunity
    public function createContext_opportunity($id_version = null, $status_version = null, $quility_plan = null)
    {
        helper(['form']);
        $Address_Risk_Opp_Context_Data_Models = new Address_Risk_Opp_Context_Data_Models();
        $Address_Risk_Opp_Context_Models = new Address_Risk_Opp_Context_Models();
        $FileModels = new FileModels();

        $issue = $this->request->getVar('issue');

        if (empty($issue)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please select issue', 'reload' => false]);
        }
        $data_address_opp = [
            'issue' => $issue,
            'id_version' => $id_version,
        ];
        $Address_Risk_Opp_Context_Models->insert($data_address_opp);
        $id_address_opp = $Address_Risk_Opp_Context_Models->insertID();
        for ($i = 1; $i < ($quility_plan + 1); $i++) {
            $checkopportunities = $this->request->getVar('checkopportunities_' . $i);
            if ($checkopportunities === '') {
                $id_file = null;
                $file = null;
                $opportunity_plannings = ($this->request->getVar('risktreatmentplan_' . $i) === '') ? null : $this->request->getVar('risktreatmentplan_' . $i);
                $opp_ownner = ($this->request->getVar('riskowner_' . $i) === '') ? null : $this->request->getVar('riskowner_' . $i);
                $start_date = ($this->request->getVar('startdate_' . $i) === '') ? null : $this->request->getVar('startdate_' . $i);
                $end_date = ($this->request->getVar('enddate_' . $i) === '') ? null : $this->request->getVar('enddate_' . $i);
                $file = $this->request->getFile('fileopp_' . $i);
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getClientName();
                    $FileModels->insert([
                        'name_file' => $newName,
                    ]);
                    $id_file = $FileModels->insertID();
                    $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                }
                $data = [
                    'id_address_risks_opp_context' => $id_address_opp,
                    'opportunity_plannings' => $opportunity_plannings,
                    'opp_ownner' => $opp_ownner,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'file' => $id_file,
                ];
                $Address_Risk_Opp_Context_Data_Models->insert($data);
            }
        }
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Created Address Opportunities',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully created Objective',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //delete data context Risk
    public function deleteContext_opportunity($id_address_risks_opp_context = null, $No = null, $id_version = null, $status_version = null)
    {
        $Address_Risk_Opp_Context_Data_Models = new Address_Risk_Opp_Context_Data_Models();
        $Address_Risk_Opp_Context_Models = new Address_Risk_Opp_Context_Models();
        $FileModels = new FileModels();
        helper('filesystem');
        helper(['form']);
        $data = $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context', $id_address_risks_opp_context)->findAll();
        foreach ($data as $key => $value) {
            if ($value['file'] != null) {
                $FileModels->where('id_files ', $value['file'])->delete($value['file']);
                $del_path = 'public/uploads/' . $value['file'] . '/'; // For Delete folder

                $check1 = delete_files($del_path, true); // Delete files into the folder
                $check2 = rmdir($del_path);
                if (!$check1) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete Address Opportunities file!',
                    ];
                    return $this->response->setJSON($response);
                }
                if (!$check2) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete folder Address Opportunities!',
                    ];
                    return $this->response->setJSON($response);
                }
            }
            $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context_data', $value['id_address_risks_opp_context_data'])->delete();
        }
        $check = $Address_Risk_Opp_Context_Models->where('id_address_risks_opp_context', $id_address_risks_opp_context)->delete($id_address_risks_opp_context);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Address Opportunities No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Address Opportunities',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Address Opportunities No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //get data context opportunity
    public function getContext_data_opportunity($id_version = null)
    {
        $Address_Risk_Opp_Context_Data_Models = new Address_Risk_Opp_Context_Data_Models();
        $Address_Risk_Opp_Context_Models = new Address_Risk_Opp_Context_Models();
        $FileModels = new FileModels();
        $totalRecords = $Address_Risk_Opp_Context_Models->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Address_Risk_Opp_Context_Models->groupStart()
                ->like('issue', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                // ->orLike('effect', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $data = $Address_Risk_Opp_Context_Models->where('id_version', $id_version)->findAll($limit, $start);


        foreach ($data as $key => $value) {
            $data[$key]['opp_data'] = $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context', $value['id_address_risks_opp_context'])->findAll();
            foreach ($data[$key]['opp_data'] as $key2 => $value2) {
                $data[$key]['opp_data'][$key2]['file'] = $FileModels->where('id_files', $value2['file'])->first();
            }
        }

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }

    // index Edit Context Risk & opportunities
    public function indexEditContext_opportunity($id_version = null, $num_ver = null, $id_address_risks_opp_context = null)
    {
        $InternalModels = new InternalModels();
        $ExternalModels = new ExternalModels();
        $InterestedModels = new InterestedModels();
        $Internal_issuesModels = new Internal_issuesModels();
        $External_issuesModels = new External_issuesModels();
        $Interested_issuesModels = new Interested_issuesModels();
        $AllversionModels = new AllversionModels();
        $Address_Risk_Opp_Context_Data_Models = new Address_Risk_Opp_Context_Data_Models();
        $Address_Risk_Opp_Context_Models = new Address_Risk_Opp_Context_Models();
        $FileModels = new FileModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 8)->first();
        $all_version_internal_external = $AllversionModels
            ->where('type_version', 1)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_internal_external)) {
            $data['internal_data'] = $InternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_internal, id_internal_issues')->findAll();
            foreach ($data['internal_data'] as $key => $value) {
                $data['internal_data'][$key]['internal_issues'] = $Internal_issuesModels->where('id_internal_issues', $value['id_internal_issues'])->select('topic')->first();
            }
            $data['external_data'] = $ExternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_external, id_external_issues')->findAll();
            foreach ($data['external_data'] as $key => $value) {
                $data['external_data'][$key]['external_issues'] = $External_issuesModels->where('id_external_issues', $value['id_external_issues'])->select('topic')->first();
            }
        } else {
            $data['internal_data'] = null;
            $data['external_data'] = null;
        }

        $all_version_interested = $AllversionModels
            ->where('type_version', 2)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_interested)) {
            $data['interested_data'] = $InterestedModels->where('id_version', $all_version_interested['id_version'])->findAll();
            foreach ($data['interested_data'] as $key => $value) {
                $data['interested_data'][$key]['interested_issues'] = $Interested_issuesModels->where('id_interested_issues', $value['id_interested_issues'])->select('topic')->first();
            }
        } else {
            $data['interested_data'] = null;
        }


        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data
        $data['data_risk'] = null;
        $data['data_opportunity'] = $Address_Risk_Opp_Context_Models->where('id_address_risks_opp_context', $id_address_risks_opp_context)->first();
        $data['data_opportunity']['data_opp'] = $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context', $data['data_opportunity']['id_address_risks_opp_context'])->findAll();
        foreach ($data['data_opportunity']['data_opp'] as $key => $value) {
            $data['data_opportunity']['data_opp'][$key]['file'] = $FileModels->where('id_files', $value['file'])->first();
        }

        $data['viewMode'] = false;
        echo view('layout/header');
        echo view('Planning/CRUD_RiskOppContext', $data);
    }

    //edit context opportunity
    public function editContext_opportunity($id_version = null, $status_version = null, $quility_plan = null, $id_address_risks_opp_context = null)
    {
        helper(['form']);
        helper('filesystem');
        $Address_Risk_Opp_Context_Data_Models = new Address_Risk_Opp_Context_Data_Models();
        $Address_Risk_Opp_Context_Models = new Address_Risk_Opp_Context_Models();
        $FileModels = new FileModels();

        $issue = $this->request->getVar('issue');

        if (empty($issue)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please select issue', 'reload' => false]);
        }
        $Address_Risk_Opp_Context_Models->update($id_address_risks_opp_context, [
            'issue' => $issue
        ]);
        $data_id_opp = $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context', $id_address_risks_opp_context)->select('id_address_risks_opp_context_data')->findAll();
        $data_id_input = [];
        for ($i = 0; $i < ($quility_plan + 1); $i++) {
            $checkopportunities = $this->request->getVar('checkopportunities_' . $i);
            $data_id_input[$i] = $checkopportunities;
            if ($checkopportunities === '') {
                $id_file = null;
                $file = null;
                $opportunity_plannings = ($this->request->getVar('risktreatmentplan_' . $i) === '') ? null : $this->request->getVar('risktreatmentplan_' . $i);
                $opp_ownner = ($this->request->getVar('riskowner_' . $i) === '') ? null : $this->request->getVar('riskowner_' . $i);
                $start_date = ($this->request->getVar('startdate_' . $i) === '') ? null : $this->request->getVar('startdate_' . $i);
                $end_date = ($this->request->getVar('enddate_' . $i) === '') ? null : $this->request->getVar('enddate_' . $i);
                $file = $this->request->getFile('fileopp_' . $i);
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getClientName();
                    $FileModels->insert([
                        'name_file' => $newName,
                    ]);
                    $id_file = $FileModels->insertID();
                    $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                }
                $data = [
                    'id_address_risks_opp_context' => $id_address_risks_opp_context,
                    'opportunity_plannings' => $opportunity_plannings,
                    'opp_ownner' => $opp_ownner,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'file' => $id_file,
                ];
                $Address_Risk_Opp_Context_Data_Models->insert($data);
            } elseif ($checkopportunities !== null) {
                $opportunity_plannings = ($this->request->getVar('risktreatmentplan_' . $i) === '') ? null : $this->request->getVar('risktreatmentplan_' . $i);
                $opp_ownner = ($this->request->getVar('riskowner_' . $i) === '') ? null : $this->request->getVar('riskowner_' . $i);
                $start_date = ($this->request->getVar('startdate_' . $i) === '') ? null : $this->request->getVar('startdate_' . $i);
                $end_date = ($this->request->getVar('enddate_' . $i) === '') ? null : $this->request->getVar('enddate_' . $i);
                $file = $this->request->getFile('fileopp_' . $i);
                if ($file !== null && $file->isValid()) {
                    $newName = $file->getClientName();
                    $check_file = $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context_data', $checkopportunities)->findAll();
                    if ($check_file[0]['file']) {
                        $del_path = 'public/uploads/' . $check_file[0]['file'] . '/'; // For Delete folder
                        $check_de_file = delete_files($del_path, false); // Delete files into the folder
                        if (!$check_de_file) {
                            $response = [
                                'success' => false,
                                'message' => 'Unable to add new files!',
                            ];
                            return $this->response->setJSON($response);
                        } else {
                            $file->move(ROOTPATH . 'public/uploads/' . $check_file[0]['file'], $newName);
                            $file_update = [
                                'name_file' => $newName,
                            ];
                            $FileModels->update($check_file[0]['file'], $file_update);
                        }
                    } else {
                        $FileModels->insert([
                            'name_file' => $newName,
                        ]);
                        $id_file__ = $FileModels->insertID();
                        $file->move(ROOTPATH . 'public/uploads/' . $id_file__, $newName);
                        $data = [
                            'file' => $id_file__,
                        ];
                        $Address_Risk_Opp_Context_Data_Models->update($checkopportunities, $data);
                    }
                }
                $data = [
                    'id_address_risks_opp_context' => $id_address_risks_opp_context,
                    'opportunity_plannings' => $opportunity_plannings,
                    'opp_ownner' => $opp_ownner,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                ];
                $Address_Risk_Opp_Context_Data_Models->update($checkopportunities, $data);
            }
        }
        $data_id_opp_ids = array_column($data_id_opp, 'id_address_risks_opp_context_data');
        $missing_ids = array_diff($data_id_opp_ids, $data_id_input);
        if (!empty($missing_ids)) {
            foreach ($missing_ids as $missing_id) {
                $value_delete = $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context_data', $missing_id)->first();
                if ($value_delete['file'] != null) {
                    $FileModels->where('id_files ', $value_delete['file'])->delete($value_delete['file']);
                    $del_path = 'public/uploads/' . $value_delete['file'] . '/'; // For Delete folder

                    $check1 = delete_files($del_path, true); // Delete files into the folder
                    $check2 = rmdir($del_path);
                    if (!$check1) {
                        $response = [
                            'success' => false,
                            'message' => 'Unable to delete Address Opportunities file!',
                        ];
                        return $this->response->setJSON($response);
                    }
                    if (!$check2) {
                        $response = [
                            'success' => false,
                            'message' => 'Unable to delete folder Address Opportunities!',
                        ];
                        return $this->response->setJSON($response);
                    }
                }
                $Address_Risk_Opp_Context_Data_Models->delete($missing_id);
            }
        }

        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Address Opportunities',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Edit Objective',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    // index View Context opportunities
    public function indexViewContext_opportunity($id_version = null, $num_ver = null, $id_address_risks_opp_context = null)
    {
        $InternalModels = new InternalModels();
        $ExternalModels = new ExternalModels();
        $InterestedModels = new InterestedModels();
        $Internal_issuesModels = new Internal_issuesModels();
        $External_issuesModels = new External_issuesModels();
        $Interested_issuesModels = new Interested_issuesModels();
        $AllversionModels = new AllversionModels();
        $Address_Risk_Opp_Context_Data_Models = new Address_Risk_Opp_Context_Data_Models();
        $Address_Risk_Opp_Context_Models = new Address_Risk_Opp_Context_Models();
        $FileModels = new FileModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 8)->first();
        $all_version_internal_external = $AllversionModels
            ->where('type_version', 1)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_internal_external)) {
            $data['internal_data'] = $InternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_internal, id_internal_issues')->findAll();
            foreach ($data['internal_data'] as $key => $value) {
                $data['internal_data'][$key]['internal_issues'] = $Internal_issuesModels->where('id_internal_issues', $value['id_internal_issues'])->select('topic')->first();
            }
            $data['external_data'] = $ExternalModels->where('id_version', $all_version_internal_external['id_version'])->select('id_external, id_external_issues')->findAll();
            foreach ($data['external_data'] as $key => $value) {
                $data['external_data'][$key]['external_issues'] = $External_issuesModels->where('id_external_issues', $value['id_external_issues'])->select('topic')->first();
            }
        } else {
            $data['internal_data'] = null;
            $data['external_data'] = null;
        }

        $all_version_interested = $AllversionModels
            ->where('type_version', 2)
            ->where('approved_date IS NOT NULL', null, false)
            ->where('status', 4)
            ->orderBy('id_version', 'desc')
            ->first();
        if (!empty($all_version_interested)) {
            $data['interested_data'] = $InterestedModels->where('id_version', $all_version_interested['id_version'])->findAll();
            foreach ($data['interested_data'] as $key => $value) {
                $data['interested_data'][$key]['interested_issues'] = $Interested_issuesModels->where('id_interested_issues', $value['id_interested_issues'])->select('topic')->first();
            }
        } else {
            $data['interested_data'] = null;
        }


        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data
        $data['data_risk'] = null;
        $data['data_opportunity'] = $Address_Risk_Opp_Context_Models->where('id_address_risks_opp_context', $id_address_risks_opp_context)->first();
        $data['data_opportunity']['data_opp'] = $Address_Risk_Opp_Context_Data_Models->where('id_address_risks_opp_context', $data['data_opportunity']['id_address_risks_opp_context'])->findAll();
        foreach ($data['data_opportunity']['data_opp'] as $key => $value) {
            $data['data_opportunity']['data_opp'][$key]['file'] = $FileModels->where('id_files', $value['file'])->first();
        }

        $data['viewMode'] = true;
        echo view('layout/header');
        echo view('Planning/CRUD_RiskOppContext', $data);
    }

    public function indexCrudIS()
    {
        echo view('layout/header');
        echo view('Planning/CRUD_RiskOppIS');
    }
}
