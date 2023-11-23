<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\ISPolicyModels;
use App\Models\FileModels;
use App\Models\RequirementModels;

class Leadership_PolicyController extends BaseController
{

    public function is_policy_index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 6)->first();

        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Leadership/is_policy', $data);
    }
    public function store($id_version = null)
    {
        helper(['form']);
        $is_policymodel = new ISPolicyModels();
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
        $check = $is_policymodel->save($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create IS Policy!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created IS Policy',
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
        $is_policymodel = new ISPolicyModels();
        $id_policy = $this->request->getVar('id_');
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $check_file = $is_policymodel->where('id_policy', $id_policy)->findAll();
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
                    $is_policymodel->update($id_policy, $data);
                    $response = [
                        'success' => true,
                        'message' => 'IS Policy data edited successfully!',
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
                $is_policymodel->update($id_policy, $data);
                $response = [
                    'success' => true,
                    'message' => 'IS Policy data edited successfully!',
                    'reload' => true,
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Please upload file.',
                'file' => $id_policy,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete($id = null, $idfile = null, $No = null)
    {
        $is_policymodel = new ISPolicyModels();
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
                    'message' => 'Unable to delete IS Policy file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder IS Policy!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $is_policymodel->where('id_policy', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete IS Policy No. ' . $No . ' !',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted IS Policy No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_file($id = null, $idfile = null, $No = null)
    {
        $is_policymodel = new ISPolicyModels();
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
                    'message' => 'Unable to delete IS Policy file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder IS Policy!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $is_policymodel->update($id, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete IS Policy file No. ' . $No . ' !',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted IS Policy file No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function copyData($id = null, $No = null)
    {
        $filemodel = new FileModels();
        $is_policymodel = new ISPolicyModels();
        $id_policy = $is_policymodel->where('id_policy', $id)->findAll();
        $file = $filemodel->where('id_files', $id_policy[0]['id_file'])->findAll();
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
                    'message' => 'Unable to copy IS Policy file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $is_policymodel->copyDataById($id);
            if ($newData == true) {
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied IS Policy No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy IS Policy No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $is_policymodel->copyDataById($id);
        $id_policy_new = $is_policymodel->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $is_policymodel->update($id_policy_new, $inter_update);
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

    public function get_is_policy_table($id_version = null)
    {

        $is_policymodel = new ISPolicyModels();
        $totalRecords = $is_policymodel->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $is_policymodel->groupStart()
                ->like('id_policy', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('id_file', $searchValue)
                ->orLike('date_upload', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $customSelect = '* , id_policy AS id_';
        $sql = 'files_table.id_files = leadership_policy_table.id_file';

        $data = $is_policymodel
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