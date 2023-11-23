<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\Leadership_ResponsibilitiesModels;
use App\Models\AllversionModels;
use App\Models\FileModels;

class Leadership_ISMSController extends BaseController
{
    public function index($id_version = null)
    {
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 7)->first();
        $AllversionModels = new AllversionModels();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();

        echo view('layout/header');
        echo view('Leadership/ISMS_Roles_Responsibi', $data);
    }

    public function responsibilities_create($id_version = null)
    {
        helper('filesystem');
        helper(['form']);
        $Leadership_ResponsibilitiesModels = new Leadership_ResponsibilitiesModels();
        $filemodel = new FileModels();
        $file = $this->request->getFile('file');
        $id_file = 0;
        $rules = [
            'responsibilities' => 'required|min_length[1]|max_length[200]',
            'name_lastname' => 'required|min_length[1]|max_length[200]',
        ];
        if ($this->validate($rules)) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getClientName();

                $filemodel->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $filemodel->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
            }
            $data = [
                'roles' => $this->request->getVar('roles_select'),
                'responsibilities' => $this->request->getVar('responsibilities'),
                'name_lastname' => $this->request->getVar('name_lastname'),
                'id_file' => $id_file,
                'id_version' => $id_version,
            ];
            $check = $Leadership_ResponsibilitiesModels->save($data);

            if ($check == false) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to create ISMS Roles & Responsibilities!',
                ];
            } else {
                $response = [
                    'success' => true,
                    'message' => 'Successfully created ISMS Roles & Responsibilities',
                    'reload' => true,
                ];
            }
        } else {
            $data['validation'] = $this->validator;
            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(),
                // Get validation errors
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function responsibilities_edit($id_responsibilities = null)
    {
        helper('filesystem');
        helper(['form']);
        $Leadership_ResponsibilitiesModels = new Leadership_ResponsibilitiesModels();
        $filemodel = new FileModels();
        $file = $this->request->getFile('file');
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $Leadership_ResponsibilitiesModels->where('id_responsibilities', $id_responsibilities)->findAll();
            if ($check_file[0]['id_file']) {
                $del_path = 'public/uploads/' . $check_file[0]['id_file'] . '/'; // For Delete folder
                $check_de_file = delete_files($del_path, false); // Delete files into the folder
                if (!$check_de_file) {
                    $response = [
                        'success' => false,
                        'message' => 'ไม่สามารถเพิ่มไฟล์ใหม่ได้!',
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
                $Leadership_ResponsibilitiesModels->update($id_responsibilities, $data);
            }
        }
        $rules = [
            'responsibilities' => 'required|min_length[1]|max_length[200]',
            'name_lastname' => 'required|min_length[1]|max_length[200]',
        ];
        if ($this->validate($rules)) {
            $data_update = [
                'roles' => $this->request->getVar('roles_select'),
                'responsibilities' => $this->request->getVar('responsibilities'),
                'name_lastname' => $this->request->getVar('name_lastname'),
            ];
            $check_update = $Leadership_ResponsibilitiesModels->update($id_responsibilities, $data_update);
            if ($check_update == false) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to edit ISMS Roles & Responsibilities information. !',
                ];
            } else {
                $response = [
                    'success' => true,
                    'message' => 'ISMS Roles & Responsibilities data edited successfully. !',
                    'reload' => true,
                ];
            }
        } else {
            $data['validation'] = $this->validator;

            $response = [
                'success' => false,
                'message' => 'ผิดพลาด',
                'validator' => $this->validator->getErrors(),
                // Get validation errors
                'reload' => false,
            ];
        }

        return $this->response->setJSON($response);
    }

    public function responsibilities_copy($id_responsibilities = null)
    {
        helper('filesystem');
        $filemodel = new FileModels();
        $Leadership_ResponsibilitiesModels = new Leadership_ResponsibilitiesModels();
        $data_responsibilities = $Leadership_ResponsibilitiesModels->where('id_responsibilities', $id_responsibilities)->findAll();
        $file = $filemodel->where('id_files', $data_responsibilities[0]['id_file'])->findAll();
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
                    'message' => 'Unable to copy Interested Party file!',
                ];
                return $this->response->setJSON($response);
            }
        } else {
            $newData = $Leadership_ResponsibilitiesModels->copyDataById($id_responsibilities);
            if ($newData == true) {
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied ISMS Roles & Responsibilities !',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy ISMS Roles & Responsibilities !',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $Leadership_ResponsibilitiesModels->copyDataById($id_responsibilities);
        $id_responsibilities_new = $Leadership_ResponsibilitiesModels->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $Leadership_ResponsibilitiesModels->update($id_responsibilities_new, $inter_update);
        if ($newData == true) {
            $response = [
                'success' => true,
                'message' => 'Successfully copied ISMS Roles & Responsibilities !',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy ISMS Roles & Responsibilities !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function responsibilities_delete($id_responsibilities = null, $idfile = null)
    {
        $Leadership_ResponsibilitiesModels = new Leadership_ResponsibilitiesModels();
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
                    'message' => 'Unable to delete ISMS Roles & Responsibilities file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder ISMS Roles & Responsibilities!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $Leadership_ResponsibilitiesModels->where('id_responsibilities', $id_responsibilities)->delete($id_responsibilities);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete ISMS Roles & Responsibilities!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted ISMS Roles & Responsibilities!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function responsibilities_delete_file($id_responsibilities = null, $idfile = null)
    {
        helper('filesystem');
        $Leadership_ResponsibilitiesModels = new Leadership_ResponsibilitiesModels();
        if ($idfile) {
            $filemodel = new FileModels();
            $filemodel->where('id_files ', $idfile)->delete($idfile);
            $del_path = 'public/uploads/' . $idfile . '/'; // For Delete folder

            $check1 = delete_files($del_path, true); // Delete files into the folder
            $check2 = rmdir($del_path);
            if (!$check1) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete ISMS Roles & Responsibilities file file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder ISMS Roles & Responsibilities file!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $Leadership_ResponsibilitiesModels->update($id_responsibilities, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete ISMS Roles & Responsibilities file!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully deleted ISMS Roles & Responsibilities file!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function getdatatable_Responsibilities($id_version = null)
    {
        $Leadership_ResponsibilitiesModels = new Leadership_ResponsibilitiesModels();
        $totalRecords = $Leadership_ResponsibilitiesModels->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $data = $Leadership_ResponsibilitiesModels->where('id_version', $id_version)->findAll($limit, $start);

        $recordsFiltered = $totalRecords;
        $sql = 'files_table.id_files = leadership_responsibilities_table.id_file';

        $data = $Leadership_ResponsibilitiesModels
            ->select()
            ->join('files_table', $sql, 'LEFT')
            ->where('id_version', $id_version) // Use the table alias for the id_version field
            ->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }
}