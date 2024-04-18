<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\AllversionModels;
use App\Models\TimelineModels;
use App\Models\FileModels;
use App\Models\Support_Communication;

class Support_CommunicationController extends BaseController
{
    //-- index Competence --//
    public function index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 14)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Support/Communication', $data);
    }

    //-- create communication --//
    public function create_communication($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Support_Communication = new Support_Communication();
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();

        $file = $this->request->getFile('attachmentfile');
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
            'what_to_communicate' => $this->request->getVar('whattocommunicate'),
            'detail' => $this->request->getVar('detail'),
            'communicator' => $this->request->getVar('communicator'),
            'communicate_with_whom' => $this->request->getVar('communicatewithwhom'),
            'when_to_communicate' => $this->request->getVar('whentocommunicate'),
            'how_to_communicate' => $this->request->getVar('howtocommunicate'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];
        $check = $Support_Communication->save($data);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Communication',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Create Communication',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Create Communication!',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- edit communication --//
    public function edit_communication($id_communication = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        helper('filesystem');
        $Support_Communication = new Support_Communication();
        $TimelineModels = new TimelineModels();
        $filemodel = new FileModels();

        $file = $this->request->getFile('attachmentfile');
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $Support_Communication->where('id_communication', $id_communication)->findAll();
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
                $Support_Communication->update($id_communication, $data);
            }
        }
        $data__ = [
            'what_to_communicate' => $this->request->getVar('whattocommunicate'),
            'detail' => $this->request->getVar('detail'),
            'communicator' => $this->request->getVar('communicator'),
            'communicate_with_whom' => $this->request->getVar('communicatewithwhom'),
            'when_to_communicate' => $this->request->getVar('whentocommunicate'),
            'how_to_communicate' => $this->request->getVar('howtocommunicate'),
        ];
        $check = $Support_Communication->update($id_communication, $data__);

        if ($check) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Communication',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully Edit Communication',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to Edit Communication',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- delete communication --//
    public function delete_communication($id_communication = null, $No = null, $id_version = null, $status_version = null)
    {
        $Support_Communication = new Support_Communication();
        helper('filesystem');
        $data_communication_idfile = $Support_Communication->where('id_communication', $id_communication)->select('id_file')->first();
        if ($data_communication_idfile['id_file'] != null) {
            $data_communication_idfile = explode(',', $data_communication_idfile['id_file']);

            foreach ($data_communication_idfile as $key => $value) {
                $filemodel = new FileModels();
                $filemodel->where('id_files ', $value)->delete($value);
                $del_path = 'public/uploads/' . $value . '/'; // For Delete folder

                $check1 = delete_files($del_path, true); // Delete files into the folder
                $check2 = rmdir($del_path);
                if (!$check1) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete Communication file!',
                    ];
                    return $this->response->setJSON($response);
                }
                if (!$check2) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to delete folder Communication!',
                    ];
                    return $this->response->setJSON($response);
                }
            }
        }

        $check = $Support_Communication->where('id_communication', $id_communication)->delete($id_communication);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Communication No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Communication',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Communication No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- copy communication --//
    public function copy_communication($id_communication = null, $No = null, $id_version = null, $status_version = null)
    {
        $filemodel = new FileModels();
        $Support_Communication = new Support_Communication();
        $id_file__ = null;
        $data_communication_idfile = $Support_Communication->where('id_communication', $id_communication)->select('id_file')->first();
        if ($data_communication_idfile['id_file'] != null) {
            $data_communication_idfile = explode(',', $data_communication_idfile['id_file']);
            foreach ($data_communication_idfile as $key => $value) {
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
                            'message' => 'Unable to copy Communication file!',
                        ];
                        return $this->response->setJSON($response);
                    }
                }
            }
            $id_file__ = rtrim($id_file__, ',');
        } else {
            $newData = $Support_Communication->copyDataById($id_communication);
            if ($newData == true) {
                $TimelineModels = new TimelineModels();
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Communication',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Communication No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Communication No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $Support_Communication->copyDataById($id_communication);
        $id_communication_new = $Support_Communication->insertID();
        $communication_update = [
            'id_file' => $id_file__
        ];
        $Support_Communication->update($id_communication_new, $communication_update);
        if ($newData == true) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Communication',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Communication No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Communication No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    //-- get data communication --//
    public function get_data_communication($id_version = null)
    {
        $Support_Communication = new Support_Communication();
        $filemodel = new FileModels();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Support_Communication->groupStart()
                ->like('id_communication ', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('course', $searchValue)
                ->groupEnd();
        }
        $totalRecords = $Support_Communication->where('id_version', $id_version)->countAllResults();
        $recordsFiltered = $totalRecords;

        if (!empty($searchValue)) {
            $Support_Communication->groupStart()
                ->like('id_communication', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('course', $searchValue)
                ->groupEnd();
        }
        $data = $Support_Communication->where('id_version', $id_version)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            $data[$key]['file_data'] = $filemodel->where('id_files', $value['id_file'])->first();
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
