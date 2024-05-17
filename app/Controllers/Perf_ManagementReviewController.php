<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\FileModels;
use App\Models\ManagementReviewModels;

class Perf_ManagementReviewController extends BaseController
{
    public function index_management_review()
    {
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();

        echo view('layout/header');
        echo view('Performance/Perf_ManagementReview', $data);
    }

    //-- create management review --//
    public function create_management_review()
    {
        helper(['form']);
        helper('filesystem');
        $ManagementReviewModels = new ManagementReviewModels();
        $filemodel = new FileModels();
        $id_files_meeting_doc = null;
        $id_file_meeting_minutes_doc = null;
        $files = $this->request->getFiles(); // Use getFiles to get an array of uploaded files

        if (isset($files['file']) && is_array($files['file'])) {
            foreach ($files['file'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getClientName();
                    $filemodel->insert([
                        'name_file' => $newName,
                    ]);
                    $id_files_meeting_doc .= $filemodel->insertID() . ',';
                    $file->move(ROOTPATH . 'public/uploads/' . $filemodel->insertID(), $newName);
                }
            }
            $id_files_meeting_doc = rtrim($id_files_meeting_doc, ',');
        }

        $file_meeting_minutes_doc = $this->request->getFile('meeting_minutes_doc');
        if ($file_meeting_minutes_doc->isValid() && !$file_meeting_minutes_doc->hasMoved()) {
            $newName = $file_meeting_minutes_doc->getClientName();
            $filemodel->insert([
                'name_file' => $newName,
            ]);
            $id_file_meeting_minutes_doc = $filemodel->insertID();
            $file_meeting_minutes_doc->move(ROOTPATH . 'public/uploads/' . $id_file_meeting_minutes_doc, $newName);
        }

        $data = [
            'meeting_id' => date('d/y'),
            'meeting_date' => $this->request->getVar('meetingdate'),
            'meeting_doc' => $id_files_meeting_doc,
            'meeting_minutes_doc' => $id_file_meeting_minutes_doc,
        ];
        $check = $ManagementReviewModels->save($data);

        if ($check) {
            $response = [
                'success' => true,
                'message' => 'Successfully Create Minutes of Meeting',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Create Minutes of Meeting!',
            ];
        }
        return $this->response->setJSON($response);
    }

    //- edit management review --//
    public function edit_management_review($id_management_review = null)
    {
        helper(['form']);
        helper('filesystem');
        $ManagementReviewModels = new ManagementReviewModels();
        $filemodel = new FileModels();

        $id_files_meeting_doc = null;
        $files = $this->request->getFiles();

        $data_Meeting_idfile = $ManagementReviewModels->where('id_management_review', $id_management_review)->select('meeting_doc')->first();
        $data_Meeting_idfile = explode(',', $data_Meeting_idfile['meeting_doc']);

        $id_file_after = $this->request->getVar('id_file_after');
        $id_file_after = rtrim($id_file_after, ',');
        if ($id_file_after != '') {
            $id_file_after = explode(',', $id_file_after);
            foreach ($data_Meeting_idfile as $key => $value) {
                if (!in_array($value, $id_file_after)) {
                    $filemodel->where('id_files ', $value)->delete($value);
                    $del_path = 'public/uploads/' . $value . '/'; // For Delete folder
                    delete_files($del_path, true); // Delete files into the folder
                    rmdir($del_path);
                } else {
                    $id_files_meeting_doc .= $value . ',';
                }
            }
        } else {
            foreach ($data_Meeting_idfile as $key => $value) {
                $filemodel->where('id_files ', $value)->delete($value);
                $del_path = 'public/uploads/' . $value . '/'; // For Delete folder
                delete_files($del_path, true); // Delete files into the folder
                rmdir($del_path);
            }
        }
        if (isset($files['file']) && is_array($files['file'])) {
            foreach ($files['file'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getClientName();
                    $filemodel->insert([
                        'name_file' => $newName,
                    ]);
                    $id_files_meeting_doc .= $filemodel->insertID() . ',';
                    $file->move(ROOTPATH . 'public/uploads/' . $filemodel->insertID(), $newName);
                }
            }
            $id_files_meeting_doc = rtrim($id_files_meeting_doc, ',');
        }
        if ($id_file_after != '') {
            $id_files_meeting_doc = rtrim($id_files_meeting_doc, ',');
        }

        $id_file_meeting_minutes_doc = $ManagementReviewModels->where('id_management_review', $id_management_review)->select('meeting_minutes_doc')->first();
        $id_file_meeting_minutes_doc = $id_file_meeting_minutes_doc['meeting_minutes_doc'];

        $file_meeting_minutes_doc = $this->request->getFile('meeting_minutes_doc');
        if ($file_meeting_minutes_doc->isValid() && !$file_meeting_minutes_doc->hasMoved()) {
            if ($id_file_meeting_minutes_doc != null) {
                $filemodel->where('id_files ', $id_file_meeting_minutes_doc)->delete($id_file_meeting_minutes_doc);
                $del_path = 'public/uploads/' . $id_file_meeting_minutes_doc . '/'; // For Delete folder
                delete_files($del_path, true); // Delete files into the folder
            }
            $newName = $file_meeting_minutes_doc->getClientName();
            $filemodel->insert([
                'name_file' => $newName,
            ]);
            $id_file_meeting_minutes_doc = $filemodel->insertID();
            $file_meeting_minutes_doc->move(ROOTPATH . 'public/uploads/' . $id_file_meeting_minutes_doc, $newName);
        }

        $data = [
            'meeting_date' => $this->request->getVar('meetingdate'),
            'meeting_doc' => $id_files_meeting_doc,
            'meeting_minutes_doc' => $id_file_meeting_minutes_doc,
        ];
        $check_update = $ManagementReviewModels->update($id_management_review, $data);
        if ($check_update) {
            $response = [
                'success' => true,
                'message' => 'Successfully Edit Management Review !',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Edit Management Review !',
            ];
        }
        return $this->response->setJSON($response);
    }

    //- copy management review --//
    public function copy_management_review($id_management_review = null)
    {
        helper(['form']);
        helper('filesystem');
        $ManagementReviewModels = new ManagementReviewModels();
        $filemodel = new FileModels();
        $id_file_meeting_doc = null;
        $id_file_meeting_minutes_doc = null;
        $data_management_review_meeting_doc = $ManagementReviewModels->where('id_management_review', $id_management_review)->select('meeting_doc')->first();
        $data_management_review_meeting_minutes_doc = $ManagementReviewModels->where('id_management_review', $id_management_review)->select('meeting_minutes_doc')->first();

        if ($data_management_review_meeting_doc['meeting_doc'] != null) {
            $data_management_review_meeting_doc = explode(',', $data_management_review_meeting_doc['meeting_doc']);
            foreach ($data_management_review_meeting_doc as $key => $value) {
                $file = $filemodel->where('id_files', $value)->findAll();
                if ($file) {
                    $newDataFile = $filemodel->copyDataById($file[0]['id_files']);
                    if ($newDataFile) {
                        $id_file = $filemodel->insertID();
                        $id_file_meeting_doc .= $id_file . ',';
                        $targetDir = ROOTPATH . 'public/uploads/' . $id_file; // เปลี่ยนตามต้องการ
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }
                        copy(ROOTPATH . 'public/uploads/' . $file[0]['id_files'] . '/' . $file[0]['name_file'], ROOTPATH . 'public/uploads/' . $id_file . '/' . $file[0]['name_file']);
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Unable to copy Management Review File!',
                        ];
                        return $this->response->setJSON($response);
                    }
                }
            }
            $id_file_meeting_doc = rtrim($id_file_meeting_doc, ',');
        }
        if ($data_management_review_meeting_minutes_doc['meeting_minutes_doc'] != null) {
            $data_management_review_meeting_minutes_doc = $data_management_review_meeting_minutes_doc['meeting_minutes_doc'];
            $file = $filemodel->where('id_files', $data_management_review_meeting_minutes_doc)->findAll();
            if ($file) {
                $newDataFile = $filemodel->copyDataById($file[0]['id_files']);
                if ($newDataFile) {
                    $id_file_meeting_minutes_doc = $filemodel->insertID();
                    $targetDir = ROOTPATH . 'public/uploads/' . $id_file_meeting_minutes_doc; // เปลี่ยนตามต้องการ
                    if (!is_dir($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    copy(ROOTPATH . 'public/uploads/' . $file[0]['id_files'] . '/' . $file[0]['name_file'], ROOTPATH . 'public/uploads/' . $id_file_meeting_minutes_doc . '/' . $file[0]['name_file']);
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to copy Management Review File!',
                    ];
                    return $this->response->setJSON($response);
                }
            }
        }

        $newData = $ManagementReviewModels->copyDataById($id_management_review);
        $management_update = [
            'meeting_doc' => $id_file_meeting_doc,
            'meeting_minutes_doc' => $id_file_meeting_minutes_doc
        ];
        $ManagementReviewModels->update($newData, $management_update);
        if ($newData == true) {
            $response = [
                'success' => true,
                'message' => 'Successfully copied Management Review !',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Management Review !',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- delete data management review --//
    public function delete_management_review($id_management_review = null)
    {
        helper(['form']);
        helper('filesystem');
        $ManagementReviewModels = new ManagementReviewModels();
        $filemodel = new FileModels();

        $data_management_review_meeting_doc = $ManagementReviewModels->where('id_management_review', $id_management_review)->select('meeting_doc')->first();
        $data_management_review_meeting_minutes_doc = $ManagementReviewModels->where('id_management_review', $id_management_review)->select('meeting_minutes_doc')->first();

        if ($data_management_review_meeting_doc['meeting_doc'] != null) {
            $data_management_review_meeting_doc = explode(',', $data_management_review_meeting_doc['meeting_doc']);
            foreach ($data_management_review_meeting_doc as $key => $value) {
                $file = $filemodel->where('id_files', $value)->findAll();
                if ($file) {
                    $filemodel->delete($file[0]['id_files']);
                    $del_path = 'public/uploads/' . $value . '/'; // For Delete folder
                    delete_files($del_path, true); // Delete files into the folder
                    rmdir($del_path);
                }
            }
        }

        if ($data_management_review_meeting_minutes_doc['meeting_minutes_doc'] != null) {
            $data_management_review_meeting_minutes_doc = explode(',', $data_management_review_meeting_minutes_doc['meeting_minutes_doc']);
            foreach ($data_management_review_meeting_minutes_doc as $key => $value) {
                $file = $filemodel->where('id_files', $value)->findAll();
                if ($file) {
                    $filemodel->delete($file[0]['id_files']);
                    $del_path = 'public/uploads/' . $value . '/'; // For Delete folder
                    delete_files($del_path, true); // Delete files into the folder
                    rmdir($del_path);
                }
            }
        }

        $ManagementReviewModels->delete($id_management_review);
        $response = [
            'success' => true,
            'message' => 'Successfully deleted Management Review !',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }
    
    //-- get data management review --//
    public function get_data_management_review()
    {
        $ManagementReviewModels = new ManagementReviewModels();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $totalRecords = $ManagementReviewModels->countAllResults();
        $recordsFiltered = $totalRecords;
        $data = $ManagementReviewModels->findAll($limit, $start);

        foreach ($data as $key => $value) {
            if (!empty($value['meeting_doc'] && $value['meeting_doc'] != null)) {
                $id_file = explode(',', $value['meeting_doc']);
                foreach ($id_file as $key2 => $value2) {
                    $data[$key]['meeting_doc_data'][$key2] = $filemodel->where('id_files', $value2)->first();
                }
            }
            if (!empty($value['meeting_minutes_doc'] && $value['meeting_minutes_doc'] != null)) {
                $data[$key]['meeting_minutes_doc'] = $filemodel->where('id_files', $value['meeting_minutes_doc'])->first();
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
