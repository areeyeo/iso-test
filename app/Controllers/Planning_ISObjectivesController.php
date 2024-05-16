<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\FileModels;
use App\Models\RequirementModels;
use App\Models\Planning_is_objectivesModels;
use App\Models\Planning_is_planningModels;
use App\Models\TimelineModels;

class Planning_ISObjectivesController extends BaseController
{
    public function index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $data['objective'] = $Planning_is_objectivesModels->where('id_version', $id_version)->findAll();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 9)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Planning/ISObjective', $data);
    }

    //-- objective --//
    public function create_objective($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $num_obj_no = $Planning_is_objectivesModels->where('id_version', $id_version)->countAllResults();
        $obj_no = sprintf("OBJ_%03d", $num_obj_no + 1);
        $data = [
            'objective' => $this->request->getVar('objective'),
            'evaluation' => $this->request->getVar('evaluation'),
            'obj_no' => $obj_no,
            'id_version' => $id_version
        ];
        $check = $Planning_is_objectivesModels->insert($data);
        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Objective',
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
        } else {
            $response = [
                'success' => false,
                'message' => 'Error on create Objective',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function edit_objective($id_objective = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $data = [
            'objective' => $this->request->getVar('objective'),
            'evaluation' => $this->request->getVar('evaluation'),
        ];
        $check = $Planning_is_objectivesModels->update($id_objective, $data);
        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Modified Objective',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully updated Objective',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error on update Objective',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_objective($id_objective = null, $No = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $check = $Planning_is_objectivesModels->where('id_objective', $id_objective)->delete($id_objective);
        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Objective',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Objective No. ' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error on deleted Objective',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function copy_objective($id_objective = null, $No = null, $id_version = null, $status_version = null)
    {
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $check = $Planning_is_objectivesModels->copyDataById($id_objective);
        $num_obj_no = $Planning_is_objectivesModels->where('id_version', $id_version)->countAllResults();
        $obj_no = sprintf("OBJ_%03d", $num_obj_no);
        $Planning_is_objectivesModels->update($check, ['obj_no' => $obj_no]);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Objective',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Copy Objective No. ' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Error on Copy Objective',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);


    }
    public function get_data_objective($id_version = null)
    {
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Planning_is_objectivesModels->groupStart()
                ->like('id_objective', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('objective', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $Planning_is_objectivesModels->where('id_version', $id_version)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Planning_is_objectivesModels->groupStart()
                ->like('id_objective', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('objective', $searchValue)
                ->groupEnd();
        }
        $data = $Planning_is_objectivesModels->where('id_version', $id_version)->findAll($limit, $start);


        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }


    //-- planning --//
    public function create_planning($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Planning_is_planningModels = new Planning_is_planningModels();
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();

        $file = $this->request->getFile('file');
        $id_file = 0;
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $filemodel->insert([
                'name_file' => $newName,
            ]);
            $id_file = $filemodel->insertID();
            $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
        }

        $data = [
            'id_objective' => $this->request->getVar('objective_evaluation'),
            'planning' => $this->request->getVar('project_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'owner' => $this->request->getVar('owner'),
            'file' => $id_file,
            'id_version' => $id_version,
            'date_evaluation' => $this->request->getVar('date_of_evaluation'),
            'evaluation_methods' => $this->request->getVar('evaluation_methods'),

        ];
        $check = $Planning_is_planningModels->save($data);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Planning',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Create Planning',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Create Planning!',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function edit_planning($id_planning = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        helper('filesystem');
        $Planning_is_planningModels = new Planning_is_planningModels();
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();

        $file = $this->request->getFile('file');
        
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $Planning_is_planningModels->where('id_planning', $id_planning)->findAll();
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
                    $filemodel->update($check_file[0]['file'], $file_update);
                }
            } else {
                $filemodel->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $filemodel->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                $data = [
                    'file' => $id_file,
                ];
                $Planning_is_planningModels->update($id_planning, $data);
            }
        }
        $data__ = [
            'id_objective' => $this->request->getVar('objective_evaluation'),
            'planning' => $this->request->getVar('project_name'),
            'start_date' => $this->request->getVar('start_date'),
            'end_date' => $this->request->getVar('end_date'),
            'owner' => $this->request->getVar('owner'),
            'date_evaluation' => $this->request->getVar('date_of_evaluation'),
            'evaluation_methods' => $this->request->getVar('evaluation_methods'),
        ];
        $check = $Planning_is_planningModels->update($id_planning, $data__);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Planning',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Edit Planning',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Edit Planning!',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function copy_planning($id_planning = null, $No = null, $id_version = null, $status_version = null)
    {
        $filemodel = new FileModels();
        $Planning_is_planningModels = new Planning_is_planningModels();
        $data_planning = $Planning_is_planningModels->where('id_planning', $id_planning)->findAll();
        $file = $filemodel->where('id_files', $data_planning[0]['file'])->findAll();
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
                    'message' => 'Unable to copy Planning file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $Planning_is_planningModels->copyDataById($id_planning);
            if ($newData == true) {
                $TimelineModels = new TimelineModels();
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Planning',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Planning No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Planning No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $Planning_is_planningModels->copyDataById($id_planning);
        $id_planning_new = $Planning_is_planningModels->insertID();
        $planning_update = [
            'file' => $id_file
        ];
        $Planning_is_planningModels->update($id_planning_new, $planning_update);
        if ($newData == true) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Planning',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Planning No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Planning No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_planning($id_planning = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $Planning_is_planningModels = new Planning_is_planningModels();
        helper('filesystem');

        if ($idfile) {
            $filemodel = new FileModels();
            $filemodel->where('id_files ', $idfile)->delete($idfile);
            $del_path = 'public/uploads/' . $idfile . '/'; // For Delete folder

            $check1 = delete_files($del_path, true); // Delete files into the folder
            $check2 = rmdir($del_path);
            if (!$check1) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete Planning file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Planning!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $Planning_is_planningModels->where('id_planning', $id_planning)->delete($id_planning);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Planning No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Planning',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Planning No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_data_planning($id_version = null)
    {
        $Planning_is_planningModels = new Planning_is_planningModels();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Planning_is_planningModels->groupStart()
                ->like('id_planning ', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('planning', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $Planning_is_planningModels->where('id_version', $id_version)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Planning_is_planningModels->groupStart()
                ->like('id_planning', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('planning', $searchValue)
                ->groupEnd();
        }
        $data = $Planning_is_planningModels->where('id_version', $id_version)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            $data[$key]['file_data'] = $filemodel->where('id_files', $value['file'])->first();
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

    //-- summary --//
    public function get_data_summary($id_version = null)
    {
        $Planning_is_planningModels = new Planning_is_planningModels();
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Planning_is_objectivesModels->groupStart()
                ->like('id_objective', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('objective', $searchValue)
                ->orLike('evaluation', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $Planning_is_objectivesModels->where('id_version', $id_version)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Planning_is_objectivesModels->groupStart()
                ->like('id_objective', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('objective', $searchValue)
                ->orLike('evaluation', $searchValue)
                ->groupEnd();
        }
        $data = $Planning_is_objectivesModels->where('id_version', $id_version)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            $data_Planning = $Planning_is_planningModels->where('id_objective', $value['id_objective'])->findAll();
            foreach ($data_Planning as $key1 => $value1) {
                $data_Planning[$key1]['file_data'] = $filemodel->where('id_files', $value1['file'])->first();
            }

            $data[$key]['data_planning'] = $data_Planning;
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
}
