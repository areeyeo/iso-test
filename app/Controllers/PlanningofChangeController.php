<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\ISPolicyModels;
use App\Models\Planning_of_changesModels;
use App\Models\FileModels;
use App\Models\RequirementModels;

class PlanningofChangeController extends BaseController
{

    public function planningofchange_index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 10)->first();

        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Planning/PlanningofChange', $data);
    }
    public function store($id_version = null)
    {
        helper(['form']);
        $planning_of_changesmodel = new Planning_of_changesModels();
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
        $check = $planning_of_changesmodel->save($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Planning of changes!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created Planning of changes',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function edit()
    {
        helper('filesystem');
        helper(['form']);
        $filemodel = new FileModels();
        $planning_of_changesmodel = new Planning_of_changesModels();
        $id_planning_changes = $this->request->getVar('id_');
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $check_file = $planning_of_changesmodel->where('id_planning_changes', $id_planning_changes)->findAll();
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
                    $planning_of_changesmodel->update($id_planning_changes, $data);
                    $response = [
                        'success' => true,
                        'message' => 'Planning of changes data edited successfully!',
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
                $planning_of_changesmodel->update($id_planning_changes, $data);
                $response = [
                    'success' => true,
                    'message' => 'Planning of changes data edited successfully!',
                    'reload' => true,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Please upload file.',
                'file' => $id_planning_changes,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete($id = null, $idfile = null, $No = null)
    {
        $planning_of_changesmodel = new Planning_of_changesModels();
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
                    'message' => 'Unable to delete Planning of changes file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Planning of changes!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $planning_of_changesmodel->where('id_planning_changes', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Planning of changes No. ' . $No . ' !',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Planning of changes No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_file($id = null, $idfile = null, $No = null)
    {
        $planning_of_changesmodel = new Planning_of_changesModels();
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
                    'message' => 'Unable to delete Planning of changes file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Planning of changes!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $planning_of_changesmodel->update($id, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Planning of changes file No. ' . $No . ' !',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Planning of changes file No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function copyData($id = null, $No = null)
    {
        $filemodel = new FileModels();
        $planning_of_changesmodel = new Planning_of_changesModels();
        $id_planning_changes = $planning_of_changesmodel->where('id_planning_changes', $id)->findAll();
        $file = $filemodel->where('id_files', $id_planning_changes[0]['id_file'])->findAll();
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
                    'message' => 'Unable to copy Planning of changes file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $planning_of_changesmodel->copyDataById($id);
            if ($newData == true) {
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Planning of changes No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Planning of changes No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $planning_of_changesmodel->copyDataById($id);
        $id_planning_changes_new = $planning_of_changesmodel->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $planning_of_changesmodel->update($id_planning_changes_new, $inter_update);
        if ($newData == true) {
            $response = [
                'success' => true,
                'message' => 'Successfully copied Planning of changes No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Planning of changes No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_planning_of_changes_table($id_version = null)
    {

        $planning_of_changesmodel = new Planning_of_changesModels();
        $totalRecords = $planning_of_changesmodel->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $planning_of_changesmodel->groupStart()
                ->like('id_planning_changes', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('id_file', $searchValue)
                ->orLike('date_upload', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $customSelect = '* , id_planning_changes AS id_';
        $sql = 'files_table.id_files = planning_changes_table.id_file';

        $data = $planning_of_changesmodel
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
}