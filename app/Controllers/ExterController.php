<?php

namespace App\Controllers;

use App\Models\ExternalModels;
use App\Models\FileModels;
use App\Models\TimelineModels;

class ExterController extends BaseController
{
    public function store($id_version = null, $status_version = null)
    {
        helper(['form']);
        $externalmodel = new ExternalModels();
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
            'id_external_issues' => $this->request->getVar('iss'),
            'effect' => $this->request->getVar('effect'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];
        $check = $externalmodel->save($data);
        $id_exter = $externalmodel->insertID();
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create External Issues!',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create External Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully created External Issues',
                'reload' => true,
            ];  
        }
        return $this->response->setJSON($response);
    }

    public function delete($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $externalmodel = new ExternalModels();
        helper('filesystem');

        if ($idfile) {
            $filemodel = new FileModels();
            $filemodel->where('id_files ', $idfile)->delete($idfile);
            $del_path  = 'public/uploads/' . $idfile . '/'; // For Delete folder

            $check1 = delete_files($del_path, true); // Delete files into the folder
            $check2 = rmdir($del_path);
            if (!$check1) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete External Issues file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder External Issues!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $externalmodel->where('id_external', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete External Issues No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete External Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted External Issues No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_file($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $externalmodel = new ExternalModels();
        helper('filesystem');

        if ($idfile) {
            $filemodel = new FileModels();
            $filemodel->where('id_files ', $idfile)->delete($idfile);
            $del_path  = 'public/uploads/' . $idfile . '/'; // For Delete folder

            $check1 = delete_files($del_path, true); // Delete files into the folder
            $check2 = rmdir($del_path);
            if (!$check1) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete External Issues file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder External Issues!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $externalmodel->update($id, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete External Issues file No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete External Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted External Issues file No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function copyData($id = null, $No = null, $id_version = null, $status_version = null)
    {
        $TimelineModels = new TimelineModels();
        
        $filemodel = new FileModels();
        $externalmodel = new ExternalModels();
        $id_external = $externalmodel->where('id_external', $id)->findAll();
        $file = $filemodel->where('id_files', $id_external[0]['id_file'])->findAll();
        if ($file) {
            $newDataFile = $filemodel->copyDataById($file[0]['id_files']);
            if ($newDataFile) {
                $id_file = $filemodel->insertID();
                $targetDir = ROOTPATH  . 'public/uploads/' . $id_file; // เปลี่ยนตามต้องการ
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                copy(ROOTPATH . 'public/uploads/' . $file[0]['id_files'] . '/' . $file[0]['name_file'], ROOTPATH . 'public/uploads/' . $id_file . '/' . $file[0]['name_file']);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy External Issues file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $externalmodel->copyDataById($id);
            if ($newData == true) {
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy External Issues',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied External Issues No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy External Issues No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $externalmodel->copyDataById($id);
        $id_external_new = $externalmodel->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $externalmodel->update($id_external_new, $inter_update);
        if ($newData == true) {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy External Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied External Issues No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy External Issues No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_exter_table($id_version = null)
    {
        $externalmodel = new ExternalModels();
        $totalRecords = $externalmodel->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $externalmodel->groupStart()
                ->like('id_external', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('effect', $searchValue)
                ->orLike('medthod', $searchValue)
                ->orLike('reponsible', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $customSelect = '* , id_external_issues AS id_selected , id_external AS id_';
        $sql = 'files_table.id_files = external_table.id_file';

        $data = $externalmodel
        ->select($customSelect)
        ->join('files_table', $sql, 'LEFT')
        ->where('id_version', $id_version) // Use the table alias for the id_version field
        ->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue
        ];

        return $this->response->setJSON($response);
    }

    public function edit($id_version = null, $status_version = null)
    {
        helper('filesystem');
        helper(['form']);
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();
        $ExternalModel = new ExternalModels();
        $id_external = $this->request->getVar('id_');
        $file = $this->request->getFile('file');
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $ExternalModel->where('id_external', $id_external)->findAll();
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
                $ExternalModel->update($id_external, $data);
            }
        }
        $data = [
            'id_external_issues' => $this->request->getVar('iss'),
            'effect' => $this->request->getVar('effect'),
        ];
        $check = $ExternalModel->update($id_external, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to edit external data',
            ];
        } else {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Modified External Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'External data edited successfully!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
}
