<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\Improvements_overviewModelse;
use App\Models\FileModels;

class Impr_ImprovementsOverviewController extends BaseController
{
    public function index()
    {
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();

        echo view('layout/header');
        echo view('Improvement/Impr_ImprovementsOverview', $data);
    }

    //-- create data improvements overview --//
    public function create_improvements_overview(){
        helper(['form']);
        helper('filesystem');
        $Improvements_overviewModelse = new Improvements_overviewModelse();
        $filemodel = new FileModels();
        $file = $this->request->getFile('file');
        $id_file = null;
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $filemodel->insert([
                'name_file' => $newName,
            ]);
            $id_file = $filemodel->insertID();
            $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
        }
        $data = [
            'improvements_list' => $this->request->getVar('improvementslist'),
            'recorder' => $this->request->getVar('recorder'),
            'file' => $id_file
        ];

        $check = $Improvements_overviewModelse->insert($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Improvements Overview!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully created Improvements Overview',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    //-- edit data improvements overview --//
    public function update_improvements_overview($id_management_review = null)
    {
        helper(['form']);
        helper('filesystem');
        $Improvements_overviewModelse = new Improvements_overviewModelse();
        $filemodel = new FileModels();
        $id_file = $Improvements_overviewModelse->where('id_management_review', $id_management_review)->first()['file'];
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
            'improvements_list' => $this->request->getVar('improvementslist'),
            'recorder' => $this->request->getVar('recorder'),
            'file' => $id_file
        ];
        $check = $Improvements_overviewModelse->update($id_management_review, $data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to update Improvements Overview!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully updated Improvements Overview',
                'reload' => true,
            ];
        }

        return $this->response->setJSON($response);
    }
    //-- copy data improvements overview --//
    public function copy_improvements_overview($id_management_review = null){
        helper(['form']);
        helper('filesystem');
        $Improvements_overviewModelse = new Improvements_overviewModelse();
        $filemodel = new FileModels();
        $id_file = null;
        $id_file_old = $Improvements_overviewModelse->where('id_management_review', $id_management_review)->first()['file'];
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

        $id_management_review_new = $Improvements_overviewModelse->copyDataById($id_management_review);
        if ($id_management_review_new) {
            $Improvements_overviewModelse->update($id_management_review_new, ['file' => $id_file]);
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
    //-- delete data improvements overview --//
    public function delete_improvements_overview($id_management_review = null)
    {
        helper(['form']);
        helper('filesystem');
        $Improvements_overviewModelse = new Improvements_overviewModelse();
        $filemodel = new FileModels();

        $Improvements_overviewModelse->where('id_management_review', $id_management_review)->findAll();
        if (!empty($Improvements_overviewModelse)) {
            $data = $Improvements_overviewModelse->first();
            if (!empty($data['file']) && $data['file'] != null) {
                $filemodel->where('id_files', $data['file'])->delete($data['file']);
                $del_path = 'public/uploads/' . $data['file'] . '/'; // For Delete folder
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

            $check = $Improvements_overviewModelse->where('id_management_review', $id_management_review)->delete($id_management_review);

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
    //-- get data improvements overview --//
    public function get_data_improvements_overview()
    {
        $Improvements_overviewModelse = new Improvements_overviewModelse();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $totalRecords = $Improvements_overviewModelse->countAllResults();
        $recordsFiltered = $totalRecords;

        $data = $Improvements_overviewModelse->findAll($limit, $start);

        foreach ($data as $key => $value) {
            if (!empty($value['file'] && $value['file'] != null)) {
                $data[$key]['file_data'] = $filemodel->where('id_files', $value['file'])->first();
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
}
