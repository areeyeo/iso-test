<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\ISMS_ProcessModels;
use App\Models\FileModels;
use App\Models\RequirementModels;

class ISMS_ProcessController extends BaseController
{

    public function isms_process_index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 4)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data
        echo view('layout/header');
        echo view('Context/isms_process', $data);
    }
    public function store($id_version = null)
    {
        helper(['form']);
        $isms_processmodel = new ISMS_ProcessModels();
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
        $check = $isms_processmodel->save($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create ISMS Process!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created ISMS Process',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete($id = null, $idfile = null, $No = null)
    {
        $isms_processmodel = new ISMS_ProcessModels();
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
                    'message' => 'Unable to delete ISMS Process file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder ISMS Process!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $isms_processmodel->where('id_isms_process ', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete ISMS Process No. ' . $No . ' !',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted ISMS Process No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_file($id = null, $idfile = null, $No = null)
    {
        $isms_processmodel = new ISMS_ProcessModels();
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
                    'message' => 'Unable to delete ISMS Process file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder ISMS Process!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $isms_processmodel->update($id, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete ISMS Process file No. ' . $No . ' !',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted ISMS Process file No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function copyData($id = null, $No = null)
    {
        $filemodel = new FileModels();
        $isms_processmodel = new isms_processmodels();
        $isms_processmodel = new ISMS_ProcessModels();
        $id_isms_process = $isms_processmodel->where('id_isms_process ', $id)->findAll();
        $file = $filemodel->where('id_files', $id_isms_process[0]['id_file'])->findAll();
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
                    'message' => 'Unable to copy ISMS Process file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $isms_processmodel->copyDataById($id);
            if ($newData == true) {
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied ISMS Process No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy ISMS Process No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $isms_processmodel->copyDataById($id);
        $id_isms_process_new = $isms_processmodel->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $isms_processmodel->update($id_isms_process_new, $inter_update);
        if ($newData == true) {
            $response = [
                'success' => true,
                'message' => 'Successfully copied ISMS Process No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy ISMS Process No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_isms_process_table($id_version = null)
    {

        $isms_processmodel = new ISMS_ProcessModels();
        $totalRecords = $isms_processmodel->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $isms_processmodel->groupStart()
                ->like('id_isms_process', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('id_file', $searchValue)
                ->orLike('date_upload', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $customSelect = '* , id_isms_process AS id_';
        $sql = 'files_table.id_files = isms_process_table.id_file';

        $data = $isms_processmodel
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
        $isms_processmodel = new ISMS_ProcessModels();
        $id_isms_process = $this->request->getVar('id_');
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $check_file = $isms_processmodel->where('id_isms_process', $id_isms_process)->findAll();
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
                    $data = [
                        'date_upload' => date("d/m/Y"),
                    ];
                    $isms_processmodel->update($id_isms_process, $data);
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
                $isms_processmodel->update($id_isms_process, $data);
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
                'file' => $id_isms_process,
            ];
        }
        return $this->response->setJSON($response);
    }
}