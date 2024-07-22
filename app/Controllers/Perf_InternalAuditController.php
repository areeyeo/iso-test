<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\FileModels;
use App\Models\Audit_Plan_Models;
use App\Models\Initial_Data_Models;
use App\Models\Schedule_Plan_Models;
use App\Models\Audit_Checklist_Models;
use App\Models\Audit_Report_Models;
use App\Models\Followup_Nonconformity_Models;
use App\Models\Followup_Observation_Models;
use App\Models\Followup_Opportunity_Models;

class Perf_InternalAuditController extends BaseController
{
    public function index($id_version = null, $num_ver = null)
    {
        
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();
        $audit_planmodel = new Audit_Plan_Models();
        $data['audit_plan'] = $audit_planmodel->orderBy('id_audit_plan', 'AES')->findAll();
        
        $initial_datamodel = new Initial_Data_Models();
        $data['initial_data'] = $initial_datamodel->orderBy('id_initial_data', 'AES')->findAll();
        $schedule_planmodel = new Schedule_Plan_Models();
        $data['schedule_plan'] = $schedule_planmodel->join('audit_plan', 'audit_plan.id_audit_plan = schedule_plan.id_audit_plan', 'LEFT')->orderBy('id_schedule_plan', 'AES')->findAll();
        $audit_checklistmodel = new Audit_Checklist_Models();
        $data['audit_checklist'] = $audit_checklistmodel->orderBy('id_audit_checklist', 'AES')->findAll();
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
            'status' => 6,
            'type_version' => 1,
            'num_ver' => 1,
        ];
        
        echo view('layout/header');
        echo view('Performance/Perf_InternalAudit', $data);
    }

    public function get_data_audit_management_schedule_plan($pid)
    {
        $schedule_planmodel = new Schedule_Plan_Models();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $schedule_planmodel->where('id_audit_plan',$pid)->groupStart()
                ->like('id_schedule_plan', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $schedule_planmodel->where('id_audit_plan',$pid)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $schedule_planmodel->where('id_audit_plan',$pid)->groupStart()
                ->like('id_schedule_plan', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $data = $schedule_planmodel->where('id_audit_plan',$pid)->groupBy('date')->findAll($limit, $start);

        foreach ($data as $key => $value) {
            $data_List = $schedule_planmodel->where('date', $value['date'])->findAll();
            $data[$key]['data_list'] = $data_List;
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

    public function get_data_audit_management_audit_checklist($pid)
    {
        $audit_checklistmodel = new Audit_Checklist_Models();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $audit_checklistmodel->where('id_audit_plan',$pid)->groupStart()
                ->like('id_audit_checklist', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $audit_checklistmodel->where('id_audit_plan',$pid)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $audit_checklistmodel->where('id_audit_plan',$pid)->groupStart()
                ->like('id_audit_checklist', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $data = $audit_checklistmodel->where('id_audit_plan',$pid)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            if (!empty($value['attach_file_audit_checklist'] && $value['attach_file_audit_checklist'] != null)) {
                $data[$key]['file_data'] = $filemodel->where('id_files', $value['attach_file_audit_checklist'])->first();
            } else {
                $data[$key]['file_data'] = null;
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

    public function get_data_audit_management_audit_report($pid)
    {
        $audit_reportmodel = new Audit_Report_Models();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $audit_reportmodel->where('id_audit_plan',$pid)->groupStart()
                ->like('id_audit_report', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $audit_reportmodel->where('id_audit_plan',$pid)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $audit_reportmodel->where('id_audit_plan',$pid)->groupStart()
                ->like('id_audit_report', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('detail', $searchValue)
                ->groupEnd();
        }
        $data = $audit_reportmodel->where('id_audit_plan',$pid)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            if (!empty($value['attach_file_audit_checklist'] && $value['attach_file_audit_checklist'] != null)) {
                $data[$key]['file_data'] = $filemodel->where('id_files', $value['attach_file_audit_checklist'])->first();
            } else {
                $data[$key]['file_data'] = null;
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

    public function get_data_audit_management_audit_program()
    {
        $audit_reportmodel = new Audit_Report_Models();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $totalRecords = $audit_reportmodel->countAllResults();
        $recordsFiltered = $totalRecords;

        $data = $audit_reportmodel->join('audit_plan', 'audit_plan.id_audit_plan = audit_report.id_audit_plan', 'LEFT')->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }

    public function get_data_audit_management_audit_plan()
    {
        $audit_reportmodel = new Audit_Report_Models();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $totalRecords = $audit_reportmodel->countAllResults();
        $recordsFiltered = $totalRecords;

        $data = $audit_reportmodel->join('audit_plan', 'audit_plan.id_audit_plan = audit_report.id_audit_plan', 'LEFT')->join('initial_data', 'initial_data.id_audit_plan = audit_report.id_audit_plan', 'LEFT')->findAll($limit, $start);

        foreach ($data as $key => $value) {
            if (!empty($value['attach_file_audit_plan'] && $value['attach_file_audit_plan'] != null)) {
                $data[$key]['file_data'] = $filemodel->where('id_files', $value['attach_file_audit_plan'])->first();
            } else {
                $data[$key]['file_data'] = null;
            }
        }
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }

    public function get_data_audit_result_nonconformity()
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

    public function get_data_audit_result_observation()
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

    public function get_data_audit_result_opportunity()
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

    //-- create data audit plan --//
    public function create_audit_plan(){
        helper(['form']);
      
        $audit_planmodel = new Audit_Plan_Models();
        $initial_datamodel = new Initial_Data_Models();

        $data = [
            'program_name' => $this->request->getVar('programname'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
        ];

        $check = $audit_planmodel->insert($data);

        $data_audit_plan = $audit_planmodel->orderBy('id_audit_plan', 'DESC')->first();
        $data1 = [
            'id_audit_plan' => $data_audit_plan['id_audit_plan'],
            'attach_file_audit_plan' => 0
        ];

        $check = $initial_datamodel->insert($data1);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Audit Program!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created Audit Program',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- edit data initial_data --//
    public function update_initial_data($id_initial_data = null)
    {
        helper(['form']);
        helper('filesystem');

        $initial_datamodel = new Initial_Data_Models();
        $filemodel = new FileModels();
        $id_file = $initial_datamodel->where('id_initial_data', $id_initial_data)->first()['attach_file_audit_plan'];
        if ($id_file == 0) {
            $id_file = null;
        }
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            if ($id_file != null) {
                $del_path = 'public/uploads/' . $id_file . '/'; // For Delete folder
                delete_files($del_path, false); // Delete files into the folder
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                $filemodel->update($id_file, [
                    'name_file' => $newName,
                ]);
            } else {
                $filemodel->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $filemodel->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
            }
        }

        $data = [
            'audit_objective' => $this->request->getVar('auditobjectives'),
            'audit_scope' => $this->request->getVar('auditscope'),
            'audit_criteria' => $this->request->getVar('auditcriteria'),
            'audit_lead' => $this->request->getVar('auditlead'),
            'audit_team' => $this->request->getVar('auditteam'),
            'attach_file_audit_plan' => $id_file
        ];
        $check = $initial_datamodel->update($id_initial_data, $data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to update Initial Data!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully updated Initial Data',
                'reload' => true,
            ];
        }

        return $this->response->setJSON($response);
    }

    //-- create data schedule --//
    public function create_schedule(){
        helper(['form']);
      
        $schedule_planmodel = new Schedule_Plan_Models();

        $data = [
            'id_audit_plan' => $this->request->getVar('id_plan_schedule'),
            'date' => $this->request->getVar('date'),
            'start_time' => $this->request->getVar('starttime'),
            'end_time' => $this->request->getVar('endtime'),
            'event_name' => $this->request->getVar('eventname'),
            'detail' => $this->request->getVar('deteils'),
            'auditee' => $this->request->getVar('auditee'),
        ];

        $check = $schedule_planmodel->insert($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Audit Program!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created Audit Program',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- create data checklist --//
    public function create_checklist(){
        helper(['form']);
        helper('filesystem');
      
        $audit_checklistmodel = new Audit_Checklist_Models();
        $filemodel = new FileModels();
        $id_file = null;

        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $filemodel->insert([
                'name_file' => $newName,
            ]);
            $id_file = $filemodel->insertID();
            $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
        }

        $data = [
            'id_audit_plan' => $this->request->getVar('id_plan_checklist'),
            'inspection_topic' => $this->request->getVar('inspectiontopic'),
            'attach_file_audit_checklist' => $id_file
        ];

        $check = $audit_checklistmodel->insert($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Audit Program!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created Audit Program',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- edit data checklist --//
    public function update_checklist($id_audit_checklist = null)
    {
        helper(['form']);
        helper('filesystem');

        $audit_checklistmodel = new Audit_Checklist_Models();
        $filemodel = new FileModels();
        $id_file = $audit_checklistmodel->where('id_audit_checklist', $id_audit_checklist)->first()['attach_file_audit_checklist'];
        if ($id_file == 0) {
            $id_file = null;
        }
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            if ($id_file != null) {
                $del_path = 'public/uploads/' . $id_file . '/'; // For Delete folder
                delete_files($del_path, false); // Delete files into the folder
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                $filemodel->update($id_file, [
                    'name_file' => $newName,
                ]);
            } else {
                $filemodel->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $filemodel->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
            }
        }

        $data = [
            'inspection_topic' => $this->request->getVar('inspectiontopic'),
            'attach_file_audit_checklist' => $id_file
        ];
        $check = $audit_checklistmodel->update($id_audit_checklist, $data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to update Initial Data!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully updated Initial Data',
                'reload' => true,
            ];
        }

        return $this->response->setJSON($response);
    }

    //-- copy data checklist --//
    public function copy_checklist($id_audit_checklist = null){
        helper(['form']);
        helper('filesystem');
        $audit_checklistmodel = new Audit_Checklist_Models();
        $filemodel = new FileModels();
        $id_file = null;
        $id_file_old = $audit_checklistmodel->where('id_audit_checklist', $id_audit_checklist)->first()['attach_file_audit_checklist'];
        $file = $filemodel->where('id_files', $id_file_old)->findAll();
        if ($file) {
            $newDataFile = $filemodel->copyDataById($file[0]['id_files']);
            if ($newDataFile) {
                $id_file = $filemodel->insertID();
                $targetDir = ROOTPATH . 'public/uploads/' . $id_file; // เปลี่ยนตามต้องการ
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                copy(ROOTPATH . 'public/uploads/' . $file[0]['id_files'] . '/' . $file[0]['name_file'], ROOTPATH . 'public/uploads/' . $id_file . '/' . $file[0]['name_file']);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Improvements Overview file!',
                ];
                return $this->response->setJSON($response);
            }
        }

        $id_audit_checklist_new = $audit_checklistmodel->copyDataById($id_audit_checklist);
        if ($id_audit_checklist_new) {
            $audit_checklistmodel->update($id_audit_checklist_new, ['attach_file_audit_checklist' => $id_file]);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Improvements Overview',
                'reload' => true,
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'Unable to copy Improvements Overview!',
            ];
        }

        return $this->response->setJSON($response);
    }

    //-- delete data checklist --//
    public function delete_checklist($id_audit_checklist = null)
    {
        helper(['form']);
        helper('filesystem');
        $audit_checklistmodel = new Audit_Checklist_Models();
        $filemodel = new FileModels();

        $audit_checklistmodel->where('id_audit_checklist', $id_audit_checklist)->findAll();
        if (!empty($audit_checklistmodel)) {
            $data = $audit_checklistmodel->where('id_audit_checklist', $id_audit_checklist)->first();
            if (!empty($data['attach_file_audit_checklist']) && $data['attach_file_audit_checklist'] != null) {
                $filemodel->where('id_files', $data['attach_file_audit_checklist'])->delete($data['attach_file_audit_checklist']);
                $del_path = 'public/uploads/' . $data['attach_file_audit_checklist'] . '/'; // For Delete folder
                $check1 = delete_files($del_path, true); // Delete files into the folder
                $check2 = rmdir($del_path);
                if (!$check1) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete Improvements Overview file!',
                    ];

                    return $this->response->setJSON($response);
                }
                if (!$check2) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete folder Improvements Overview!',
                    ];

                    return $this->response->setJSON($response);
                }
            }

            $check = $audit_checklistmodel->where('id_audit_checklist', $id_audit_checklist)->delete($id_audit_checklist);

            if ($check == false) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete Improvements Overview!',
                ];
            } else {
                $response = [
                    'success' => true,
                    'message' => 'Successfully deleted Improvements Overview',
                    'reload' => true,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Improvements Overview not found!',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- create data report --//
    public function create_report(){
        helper(['form']);
        helper('filesystem');
      
        $audit_reportmodel = new Audit_Report_Models();
        $filemodel = new FileModels();
        $id_file = null;

        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $filemodel->insert([
                'name_file' => $newName,
            ]);
            $id_file = $filemodel->insertID();
            $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
        }

        $id_plan = $this->request->getVar('id_plan_report');
        $num_ar_no = $audit_reportmodel->where('id_audit_plan', $id_plan)->countAllResults();
        $ar_no = sprintf("AR_%03d", $num_ar_no + 1);

        $data = [
            'audit_report_no' => $ar_no,
            'id_audit_plan' => $this->request->getVar('id_plan_report'),
            'report_about' => $this->request->getVar('report'),
            'note' => $this->request->getVar('note'),
            'attach_file_audit_checklist' => $id_file
        ];

        $check = $audit_reportmodel->insert($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Audit Program!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created Audit Program',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- edit data report --//
    public function update_report($id_audit_report = null)
    {
        helper(['form']);
        helper('filesystem');

        $audit_reportmodel = new Audit_Report_Models();
        $filemodel = new FileModels();
        $id_file = $audit_reportmodel->where('id_audit_report', $id_audit_report)->first()['attach_file_audit_checklist'];
        if ($id_file == 0) {
            $id_file = null;
        }
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            if ($id_file != null) {
                $del_path = 'public/uploads/' . $id_file . '/'; // For Delete folder
                delete_files($del_path, false); // Delete files into the folder
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                $filemodel->update($id_file, [
                    'name_file' => $newName,
                ]);
            } else {
                $filemodel->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $filemodel->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
            }
        }

        $data = [
            'report_about' => $this->request->getVar('report'),
            'note' => $this->request->getVar('note'),
            'attach_file_audit_checklist' => $id_file
        ];
        $check = $audit_reportmodel->update($id_audit_report, $data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to update Initial Data!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully updated Initial Data',
                'reload' => true,
            ];
        }

        return $this->response->setJSON($response);
    }

    //-- copy data report --//
    public function copy_report($id_audit_report = null){
        helper(['form']);
        helper('filesystem');
        $audit_reportmodel = new Audit_Report_Models();
        $filemodel = new FileModels();
        $id_file = null;
        $id_file_old = $audit_reportmodel->where('id_audit_report', $id_audit_report)->first()['attach_file_audit_checklist'];
        $file = $filemodel->where('id_files', $id_file_old)->findAll();
        if ($file) {
            $newDataFile = $filemodel->copyDataById($file[0]['id_files']);
            if ($newDataFile) {
                $id_file = $filemodel->insertID();
                $targetDir = ROOTPATH . 'public/uploads/' . $id_file; // เปลี่ยนตามต้องการ
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                copy(ROOTPATH . 'public/uploads/' . $file[0]['id_files'] . '/' . $file[0]['name_file'], ROOTPATH . 'public/uploads/' . $id_file . '/' . $file[0]['name_file']);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Improvements Overview file!',
                ];
                return $this->response->setJSON($response);
            }
        }

        $id_audit_report_new = $audit_reportmodel->copyDataById($id_audit_report);
        if ($id_audit_report_new) {
            $id_plan = $audit_reportmodel->where('id_audit_report', $id_audit_report_new)->first()['id_audit_plan'];
            $num_ar_no = $audit_reportmodel->where('id_audit_plan', $id_plan)->countAllResults();
            $ar_no = sprintf("AR_%03d", $num_ar_no);
            $audit_reportmodel->update($id_audit_report_new, ['audit_report_no' => $ar_no]);
            $audit_reportmodel->update($id_audit_report_new, ['attach_file_audit_checklist' => $id_file]);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Improvements Overview',
                'reload' => true,
            ];
        }else{
            $response = [
                'success' => false,
                'message' => 'Unable to copy Improvements Overview!',
            ];
        }

        return $this->response->setJSON($response);
    }

    //-- delete data report --//
    public function delete_report($id_audit_report = null)
    {
        helper(['form']);
        helper('filesystem');
        $audit_reportmodel = new Audit_Report_Models();
        $filemodel = new FileModels();

        $audit_reportmodel->where('id_audit_report', $id_audit_report)->findAll();
        if (!empty($audit_reportmodel)) {
            $data = $audit_reportmodel->where('id_audit_report', $id_audit_report)->first();
            if (!empty($data['attach_file_audit_checklist']) && $data['attach_file_audit_checklist'] != null) {
                $filemodel->where('id_files', $data['attach_file_audit_checklist'])->delete($data['attach_file_audit_checklist']);
                $del_path = 'public/uploads/' . $data['attach_file_audit_checklist'] . '/'; // For Delete folder
                $check1 = delete_files($del_path, true); // Delete files into the folder
                $check2 = rmdir($del_path);
                if (!$check1) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete Improvements Overview file!',
                    ];

                    return $this->response->setJSON($response);
                }
                if (!$check2) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete folder Improvements Overview!',
                    ];

                    return $this->response->setJSON($response);
                }
            }

            $check = $audit_reportmodel->where('id_audit_report', $id_audit_report)->delete($id_audit_report);

            if ($check == false) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete Improvements Overview!',
                ];
            } else {
                $response = [
                    'success' => true,
                    'message' => 'Successfully deleted Improvements Overview',
                    'reload' => true,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Improvements Overview not found!',
            ];
        }
        return $this->response->setJSON($response);
    }
}
