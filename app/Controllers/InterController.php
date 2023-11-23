<?php

namespace App\Controllers;

use App\Models\InternalModels;
use App\Models\FileModels;
use App\Models\TimelineModels;

class InterController extends BaseController
{
    public function store($id_version = null, $status_version = null)
    {

        helper(['form']);
        $internalmodel = new InternalModels();
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
            'id_internal_issues' => $this->request->getVar('iss'),
            'effect' => $this->request->getVar('effect'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];

        $check = $internalmodel->save($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Internal Issues!',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Internal Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully created Internal Issues',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $internalmodel = new InternalModels();
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
                    'message' => 'Unable to delete Internal Issues file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Internal Issues!',
                ];
                return $this->response->setJSON($response);
            }
        }

        $check = $internalmodel->where('id_internal', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Internal Issues No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Internal Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Internal Issues No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_file($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $internalmodel = new InternalModels();
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
                    'message' => 'Unable to delete Internal Issues file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Internal Issues!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $internalmodel->update($id, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Internal Issues file No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Internal Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Internal Issues file No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function copyData($id = null, $No = null, $id_version = null, $status_version = null)
    {
        $TimelineModels = new TimelineModels();

        $filemodel = new FileModels();
        $internalmodel = new InternalModels();
        $internal = $internalmodel->where('id_internal', $id)->findAll();
        $file = $filemodel->where('id_files', $internal[0]['id_file'])->findAll();
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
                    'message' => 'Unable to copy Internal Issues file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $internalmodel->copyDataById($id);
            if ($newData == true) {
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Internal Issues',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Internal Issues No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Internal Issues No. ' . $No . ' !',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $internalmodel->copyDataById($id);
        $id_inter_new = $internalmodel->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $internalmodel->update($id_inter_new, $inter_update);
        if ($newData == true) {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Internal Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Internal Issues No. ' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Internal Issues No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_inter_table($id_version = null)
    {
        $internalmodel = new InternalModels();
        $totalRecords = $internalmodel->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $internalmodel->groupStart()
                ->like('id_internal', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('effect', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $customSelect = '* , id_internal_issues AS id_selected , id_internal AS id_';
        $sql = 'files_table.id_files = internal_table.id_file';
        $data = $internalmodel
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
        $internalmodel = new InternalModels();
        $id_internal = $this->request->getVar('id_');
        $file = $this->request->getFile('file');
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $internalmodel->where('id_internal', $id_internal)->findAll();
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
                $internalmodel->update($id_internal, $data);
            }
        }
        $data = [
            'id_internal_issues' => $this->request->getVar('iss'),
            'effect' => $this->request->getVar('effect'),
        ];
        $check = $internalmodel->update($id_internal, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to edit interested party data.',
            ];
        } else {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Modified Internal Issues',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Internal Issues data edited successfully!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
}