<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\AllversionModels;
use App\Models\TimelineModels;
use App\Models\FileModels;
use App\Models\Support_CompetenceModels;

class Support_CompetenceController extends BaseController
{
    //-- index Competence --//
    public function index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 12)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Support/Competence', $data);
    }

    //-- create Competence --//
    public function create_competence($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Support_CompetenceModels = new Support_CompetenceModels();
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
            'role' => $this->request->getVar('role'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];
        $check = $Support_CompetenceModels->save($data);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Competence',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Create Competence',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Create Competence!',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- edit Competence --//
    public function edit_competence($id_competence = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        helper('filesystem');
        $Support_CompetenceModels = new Support_CompetenceModels();
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();

        $file = $this->request->getFile('file');
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $Support_CompetenceModels->where('id_competence', $id_competence)->findAll();
            if ($check_file[0]['id_file']) {
                $del_path = 'public/uploads/' . $check_file[0]['id_file'] . '/'; // For Delete folder
                $check_de_file = delete_files($del_path, false); // Delete files into the folder
                if (!$check_de_file) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to add new files!',
                    ];
                    return $this->response->setJSON($response);
                } else {
                    $file->move(ROOTPATH . 'public/uploads/' . $check_file[0]['id_file'], $newName);
                    $file_update = [
                        'name_file' => $newName,
                    ];
                    $filemodel->update($check_file[0]['id_file'], $file_update);
                }
            } else {
                $filemodel->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $filemodel->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                $data = [
                    'id_file' => $id_file,
                ];
                $Support_CompetenceModels->update($id_competence, $data);
            }
        }
        $data__ = [
            'role' => $this->request->getVar('role'),
        ];
        $check = $Support_CompetenceModels->update($id_competence, $data__);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Competence',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Edit Competence',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Edit Competence!',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- copy Competence --//
    public function copy_competence($id_competence = null, $No = null, $id_version = null, $status_version = null)
    {
        $filemodel = new FileModels();
        $Support_CompetenceModels = new Support_CompetenceModels();
        $data_competence = $Support_CompetenceModels->where('id_competence', $id_competence)->findAll();
        $file = $filemodel->where('id_files', $data_competence[0]['id_file'])->findAll();
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
                    'message' => 'Unable to copy Competence file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $Support_CompetenceModels->copyDataById($id_competence);
            if ($newData == true) {
                $TimelineModels = new TimelineModels();
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Competence',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Competence No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Competence No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $Support_CompetenceModels->copyDataById($id_competence);
        $id_competence_new = $Support_CompetenceModels->insertID();
        $competence_update = [
            'id_file' => $id_file
        ];
        $Support_CompetenceModels->update($id_competence_new, $competence_update);
        if ($newData == true) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Competence',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Competence No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Competence No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- delete Competence --//
    public function delete_competence($id_competence = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $Support_CompetenceModels = new Support_CompetenceModels();
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
                    'message' => 'Unable to delete Competence file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Competence!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $Support_CompetenceModels->where('id_competence', $id_competence)->delete($id_competence);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Competence No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Competence',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Competence No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    //-- get data Competence --//
    public function get_data_competence($id_version = null)
    {
        $Support_CompetenceModels = new Support_CompetenceModels();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Support_CompetenceModels->groupStart()
                ->like('id_competence', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('role', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $Support_CompetenceModels->where('id_version', $id_version)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Support_CompetenceModels->groupStart()
                ->like('id_competence', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('role', $searchValue)
                ->groupEnd();
        }
        $data = $Support_CompetenceModels->where('id_version', $id_version)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            $data[$key]['file_data'] = $filemodel->where('id_files', $value['id_file'])->first();
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
