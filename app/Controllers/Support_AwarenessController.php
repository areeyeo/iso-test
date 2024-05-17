<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\AllversionModels;
use App\Models\TimelineModels;
use App\Models\FileModels;
use App\Models\Support_Awareness;

class Support_AwarenessController extends BaseController
{
    //-- index Competence --//
    public function index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 13)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Support/Awareness', $data);
    }

    //-- create awareness --//
    public function create_awareness($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Support_Awareness = new Support_Awareness();
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();
        $id_file = null;
        $files = $this->request->getFiles(); // Use getFiles to get an array of uploaded files

        if (isset($files['file']) && is_array($files['file'])) {
            foreach ($files['file'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getClientName();
                    $filemodel->insert([
                        'name_file' => $newName,
                    ]);
                    $id_file .= $filemodel->insertID() . ',';

                    $file->move(ROOTPATH . 'public/uploads/' . $filemodel->insertID(), $newName);
                }
            }
            $id_file = rtrim($id_file, ',');
        }

        $data = [
            'course' => $this->request->getVar('course'),
            'detail' => $this->request->getVar('detail'),
            'date' => $this->request->getVar('date'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];
        $check = $Support_Awareness->save($data);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Awareness',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Create Awareness',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Create Awareness!',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- edit awareness --//
    public function edit_awareness($id_awareness = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        helper('filesystem');
        $Support_Awareness = new Support_Awareness();
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();
        $id_file = null;
        $files = $this->request->getFiles(); // Use getFiles to get an array of uploaded files
        $id_file_after = $this->request->getVar('id_file_after');
        $id_file_after = rtrim($id_file_after, ',');
        $data_awareness_idfile = $Support_Awareness->where('id_awareness', $id_awareness)->select('id_file')->first();
        $data_awareness_idfile = explode(',', $data_awareness_idfile['id_file']);
        if ($id_file_after != '') {
            $id_file_after = explode(',', $id_file_after);
            foreach ($data_awareness_idfile as $key => $value) {
                if (!in_array($value, $id_file_after)) {
                    $filemodel->where('id_files ', $value)->delete($value);
                    $del_path = 'public/uploads/' . $value . '/'; // For Delete folder
                    delete_files($del_path, true); // Delete files into the folder
                    rmdir($del_path);
                } else {
                    $id_file .= $value . ',';
                }
            }
        }else {
            foreach ($data_awareness_idfile as $key => $value) {
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
                    $id_file .= $filemodel->insertID() . ',';

                    $file->move(ROOTPATH . 'public/uploads/' . $filemodel->insertID(), $newName);
                }
            }
            $id_file = rtrim($id_file, ',');
        }
        if ($id_file_after != '') {
            $id_file = rtrim($id_file, ',');
        }
        $data = [
            'course' => $this->request->getVar('course'),
            'detail' => $this->request->getVar('detail'),
            'date' => $this->request->getVar('date'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];
        $check_update = $Support_Awareness->update($id_awareness, $data);
        if ($check_update) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Awareness',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Edit Awareness',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Edit Awareness',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- delete awareness --//
    public function delete_awareness($id_awareness = null, $No = null, $id_version = null, $status_version = null)
    {
        $Support_Awareness = new Support_Awareness();
        helper('filesystem');
        $data_awareness_idfile = $Support_Awareness->where('id_awareness', $id_awareness)->select('id_file')->first();
        if ($data_awareness_idfile['id_file'] != null) {
            $data_awareness_idfile = explode(',', $data_awareness_idfile['id_file']);

            foreach ($data_awareness_idfile as $key => $value) {
                $filemodel = new FileModels();
                $filemodel->where('id_files ', $value)->delete($value);
                $del_path = 'public/uploads/' . $value . '/'; // For Delete folder

                $check1 = delete_files($del_path, true); // Delete files into the folder
                $check2 = rmdir($del_path);
                if (!$check1) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete Awareness file!',
                    ];
                    return $this->response->setJSON($response);
                }
                if (!$check2) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete folder Awareness!',
                    ];
                    return $this->response->setJSON($response);
                }
            }
        }

        $check = $Support_Awareness->where('id_awareness', $id_awareness)->delete($id_awareness);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Awareness No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Awareness',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Awareness No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- copy awareness --//
    public function copy_awareness($id_awareness = null, $No = null, $id_version = null, $status_version = null)
    {
        $filemodel = new FileModels();
        $Support_Awareness = new Support_Awareness();
        $id_file__ = null;
        $data_awareness_idfile = $Support_Awareness->where('id_awareness', $id_awareness)->select('id_file')->first();
        if ($data_awareness_idfile['id_file'] != null) {
            $data_awareness_idfile = explode(',', $data_awareness_idfile['id_file']);
            foreach ($data_awareness_idfile as $key => $value) {
                $file = $filemodel->where('id_files', $value)->findAll();
                if ($file) {
                    $newDataFile = $filemodel->copyDataById($file[0]['id_files']);
                    if ($newDataFile) {
                        $id_file = $filemodel->insertID();
                        $id_file__ .= $id_file . ',';
                        $targetDir = ROOTPATH . 'public/uploads/' . $id_file; // เปลี่ยนตามต้องการ
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir, 0777, true);
                        }
                        copy(ROOTPATH . 'public/uploads/' . $file[0]['id_files'] . '/' . $file[0]['name_file'], ROOTPATH . 'public/uploads/' . $id_file . '/' . $file[0]['name_file']);
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Unable to copy Awareness file!',
                        ];
                        return $this->response->setJSON($response);
                    }
                }
            }
            $id_file__ = rtrim($id_file__, ',');
        } else {
            $newData = $Support_Awareness->copyDataById($id_awareness);
            if ($newData == true) {
                $TimelineModels = new TimelineModels();
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Awareness',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Awareness No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Awareness No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $Support_Awareness->copyDataById($id_awareness);
        $id_awareness_new = $Support_Awareness->insertID();
        $awareness_update = [
            'id_file' => $id_file__
        ];
        $Support_Awareness->update($id_awareness_new, $awareness_update);
        if ($newData == true) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Awareness',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Awareness No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Awareness No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- get data awareness --//
    public function get_data_awareness($id_version = null)
    {
        $Support_Awareness = new Support_Awareness();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Support_Awareness->groupStart()
                ->like('id_awareness ', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('course', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $Support_Awareness->where('id_version', $id_version)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Support_Awareness->groupStart()
                ->like('id_awareness', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('course', $searchValue)
                ->groupEnd();
        }
        $data = $Support_Awareness->where('id_version', $id_version)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            $id_file = explode(',', $value['id_file']);
            foreach ($id_file as $key2 => $value2) {
                $data[$key]['file_data'][$key2] = $filemodel->where('id_files', $value2)->first();
            }
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
