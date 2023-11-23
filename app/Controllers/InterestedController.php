<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\InterestedModels;
use App\Models\FileModels;
use App\Models\RequirementModels;
use App\Models\Interested_issuesModels;
use App\Models\TimelineModels;

class InterestedController extends BaseController
{

    public function interested_index($id_version = null, $num_ver = null)
    {
        $AllversionModels = new AllversionModels();
        $interested_issmodel = new Interested_issuesModels();
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();

        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        $data['data_interested_iss'] = $interested_issmodel->getData();

        echo view('layout/header');
        echo view('Context/interested', $data);
    }
    public function store($id_version = null, $status_version = null)
    {
        helper(['form']);
        $TimelineModels = new TimelineModels();

        $interestedmodel = new InterestedModels();
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
            'id_interested_issues' => $this->request->getVar('iss'),
            'effect' => $this->request->getVar('effect'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];
        $check = $interestedmodel->save($data);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create Interested Party!',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Interested Party',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully created Interested Party',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $interestedmodel = new InterestedModels();
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
                    'message' => 'Unable to delete Interested Party file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Interested Party!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $interestedmodel->where('id_interested', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Interested Party No. ' . $No . ' !',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Interested Party',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Interested Party No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function delete_file($id = null, $idfile = null, $No = null, $id_version = null, $status_version = null)
    {
        $interestedmodel = new InterestedModels();
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
                    'message' => 'Unable to delete Interested Party file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder Interested Party!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $data = [
            'id_file' => 0,
        ];
        $check = $interestedmodel->update($id, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Interested Party file No. ' . $No . ' !',
            ];
        } else {
            // $activitesLogModel = new ActivitesLogModels();
            // $data_log = [
            //     'text_activities' => session()->get('name') . ' ' . session()->get('lastname') . ' ได้ลบไฟล์ใน Interested Party ที่ ' . $id . ' ของข้อมูล Context Version ที่ ' . $id_version,
            //     'type_activities' => 3,
            //     'id_user' => session()->get('id'),
            // ];
            // $activitesLogModel->save($data_log);
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Interested Party',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Interested Party file No. ' . $No . '',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    public function copyData($id = null, $No = null, $id_version = null, $status_version = null)
    {
        $filemodel = new FileModels();
        $interestedmodel = new InterestedModels();
        $id_interested = $interestedmodel->where('id_interested', $id)->findAll();
        $file = $filemodel->where('id_files', $id_interested[0]['id_file'])->findAll();
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
            $newData = $interestedmodel->copyDataById($id);
            if ($newData == true) {
                // $data_log = [
                //     'text_activities' => session()->get('name') . ' ' . session()->get('lastname') . ' ได้คัดลอกข้อมูล Interested Party ที่ ' . $id . ' ของข้อมูล Context Version ที่ ' . $id_version,
                //     'type_activities' => 1,
                //     'id_user' => session()->get('id'),
                // ];
                // $activitesLogModel->save($data_log);
                $TimelineModels = new TimelineModels();
                $data_log = [
                    'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Interested Party',
                    'type_timeline' => 1,
                    'status_id' => $status_version,
                    'id_note' => null,
                    'id_user' => session()->get('id'),
                    'id_version' => $id_version,
                ];
                $TimelineModels->save($data_log);
                $response = [
                    'success' => true,
                    'message' => 'Successfully copied Interested Party No. ' . $No . '',
                    'reload' => true,
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Unable to copy Interested Party No. ' . $No . '!',
                ];
            }
            return $this->response->setJSON($response);
        }
        $newData = $interestedmodel->copyDataById($id);
        $id_interest_new = $interestedmodel->insertID();
        $inter_update = [
            'id_file' => $id_file
        ];
        $interestedmodel->update($id_interest_new, $inter_update);
        if ($newData == true) {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Copy Interested Party',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully copied Interested Party No.' . $No . '',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Unable to copy Interested Party No. ' . $No . ' !',
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_interested_table($id_version = null)
    {

        $interestedmodel = new InterestedModels();
        $totalRecords = $interestedmodel->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $interestedmodel->groupStart()
                ->like('id_external', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                ->orLike('effect', $searchValue)
                ->orLike('medthod', $searchValue)
                ->orLike('reponsible', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $customSelect = '* , id_interested_issues AS id_selected , id_interested AS id_';
        $sql = 'files_table.id_files = interested_table.id_file';

        $data = $interestedmodel
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
        $InterestedModel = new InterestedModels();
        $id_interested = $this->request->getVar('id_');
        $file = $this->request->getFile('file');
        if ($file !== null && $file->isValid()) {
            $newName = $file->getClientName();
            $check_file = $InterestedModel->where('id_interested', $id_interested)->findAll();
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
                $InterestedModel->update($id_interested, $data);
            }
        }
        $data = [
            'id_interested_issues' => $this->request->getVar('iss'),
            'effect' => $this->request->getVar('effect'),
        ];
        $check = $InterestedModel->update($id_interested, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to edit internal data.',
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
                'message' => 'Internal data edited successfully!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
}