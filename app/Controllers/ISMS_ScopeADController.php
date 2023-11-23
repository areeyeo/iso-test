<?php

namespace App\Controllers;

use App\Models\ISMS_ScopeADModels;
use App\Models\FileModels;
use App\Models\TimelineModels;

class ISMS_ScopeADController extends BaseController
{

    public function store($id_version = null, $status_version = null)
    {
        helper(['form']);
        $TimelineModels = new TimelineModels();

        $scopeadmodel = new ISMS_ScopeADModels();
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
            'id_file' => $id_file,
            'date_upload' => date("d/m/Y"),
            'id_version' => $id_version,
        ];
        $check = $scopeadmodel->save($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Scope Activities Diagram!',
            ];
        } else {
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Scope Activities Diagram',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully created Scope Activities Diagram',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $scopeadmodel = new ISMS_ScopeADModels();
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
                    'message' => 'Unable to delete Scope Activities Diagram file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Scope Activities Diagram!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $scopeadmodel->where('id_scope_activites', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Scope Activities Diagram No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Scope Activities Diagram',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Scope Activities Diagram No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_file($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $scopeadmodel = new ISMS_ScopeADModels();
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
                    'message' => 'Unable to delete Scope Activities Diagram file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Scope Activities Diagram!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $scopeadmodel->update($id, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Scope Activities Diagram file No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Scope Activities Diagram file',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Scope Activities Diagram file No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function copyData($id = null, $No = null, $id_version = null, $status_version = null)
    {
        $filemodel = new FileModels();
        $scopeadmodel = new ISMS_ScopeADModels();
        $id_scope_activites = $scopeadmodel->where('id_scope_activites', $id)->findAll();
        $file = $filemodel->where('id_files', $id_scope_activites[0]['id_file'])->findAll();
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
                    'message' => 'Unable to copy Scope Activities Diagram file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $scopeadmodel->copyDataById($id);
            if ($newData == true) {
                // $data_log = [
                //     'text_activities' => session()->get('name') . ' ' . session()->get('lastname') . ' ได้คัดลอกข้อมูล Scope Activities Diagram ที่ ' . $id . ' ของข้อมูล Context Version ที่ ' . $id_version,
                //     'type_activities' => 1,
                //     'id_user' => session()->get('id'),
                // ];
                // $activitesLogModel->save($data_log);
                $TimelineModels = new TimelineModels();
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Scope Activities Diagram',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Scope Activities Diagram No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Scope Activities Diagram No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $scopeadmodel->copyDataById($id);
        $id_scope_activites_new = $scopeadmodel->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $scopeadmodel->update($id_scope_activites_new, $inter_update);
        if ($newData == true) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Scope Activities Diagram',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Scope Activities Diagram No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Scope Activities Diagram No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_scope_ad_table($id_version = null)
    {

        $scopeadmodel = new ISMS_ScopeADModels();
        $totalRecords = $scopeadmodel->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $scopeadmodel->groupStart()
                ->like('id_scope_activites', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('id_file', $searchValue)
                ->orLike('date_upload', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $customSelect = '* , id_scope_activites AS id_';
        $sql = 'files_table.id_files = scope_activites_table.id_file';

        $data = $scopeadmodel
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

    public function edit()
    {
        helper('filesystem');
        helper(['form']);
        $filemodel = new FileModels();
        $scopeadmodel = new ISMS_ScopeADModels();
        $id_scope_activites  = $this->request->getVar('id_');
        $file = $this->request->getFile('file');
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $scopeadmodel->where('id_scope_activites', $id_scope_activites)->findAll();
            if ($check_file[0]['id_file']) {
                $del_path = 'public/uploads/' . $check_file[0]['id_file'] . '/'; // For Delete folder
                $check_de_file = delete_files($del_path, false); // Delete files into the folder
                if (!$check_de_file) {
                    $response = [
                        'success' => false, 
                        'message' => $id_scope_activites,
                    ];
                    return $this->response->setJSON($response);
                } else {
                    $file->move(ROOTPATH . 'public/uploads/' . $check_file[0]['id_file'], $newName);
                    $file_update = [
                        'name_file' => $newName,
                    ];
                    $filemodel->update($check_file[0]['id_file'], $file_update);
                    $data = [
                        'date_upload' => date("d/m/Y"),
                    ];
                    $scopeadmodel->update($id_scope_activites , $data);
                    $response = [
                        'success' => true,
                        'message' => 'ISMS Process data edited successfully!',
                        'reload' => true,
                    ];
                }
            } else {
                $filemodel->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $filemodel->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                $data = [
                    'id_file' => $id_file,
                    'date_upload' => date("d/m/Y"),
                ];
                $scopeadmodel->update($id_scope_activites , $data);
                $response = [
                    'success' => true,
                    'message' => 'ISMS Process data edited successfully!',
                    'reload' => true,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Please upload file.',
            ];
        }
        return $this->response->setJSON($response);
    }
}