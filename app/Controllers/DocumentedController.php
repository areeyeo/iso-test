<?php

namespace App\Controllers;

use App\Models\RequirementModels;
use App\Models\AllversionModels;
use App\Models\UserModels;
use App\Models\Support_DocumentedModels;
use App\Models\FileModels;
use App\Models\TimelineModels;

class DocumentedController extends BaseController
{
    private $data_name_doc = [
        'Management system manaul' => 'MS_',
        'Policy' => 'PO_',
        'Plan' => 'PL_',
        'Procedure' => 'PR_',
        'Workintruction' => 'WI_',
        'Form' => 'FM_',
        'External' => 'EX_',
    ];
    public function index($id_version = null, $num_ver = null)
    {
        $RequirementModels = new RequirementModels();
        $AllversionModels = new AllversionModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 15)->first();
        $data['data'] = $AllversionModels->where('id_version', $id_version)->first();
        $numver = [
            'num_ver' => $num_ver
        ];
        $data['data'] = array_merge($data['data'], $numver); // Merge the new version data

        echo view('layout/header');
        echo view('Support/Documented', $data);
    }

    //index create documented
    public function indexCrudCreateUpdate($id_version = null, $num_ver = null, $status_version = null)
    {
        $UserModels = new UserModels();

        $data['user_data'] = $UserModels->findAll();
        $data['$id_version'] = $id_version;
        $data['data'] = [
            'id_version' => $id_version,
            'num_ver' => $num_ver,
            'status' => $status_version
        ];
        $data['data_doc'] = null;
        $data['edit_mode'] = ''; // '' or 'disabled'

        echo view('layout/header');
        echo view('Support/CRUD_Create_Update', $data);
    }

    //create documented
    public function create_documented($id_version = null, $num_ver = null, $status_version = null)
    {
        helper(['form']);
        helper('filesystem');
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $document_type = $this->request->getVar('document_type');
        $id_file = null;

        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            $FileModels->insert([
                'name_file' => $newName,
            ]);
            $id_file = $FileModels->insertID();
            $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
        }
        $document_abbreviation = $Support_DocumentedModels->where('id_version', $id_version)->where('document_type', $document_type)->selectMax('document_abbreviation')->first();
        if ($document_abbreviation['document_abbreviation'] != null) {
            $document_abbreviation_ = explode('_', $document_abbreviation['document_abbreviation']);
            $document_abbreviation = $document_abbreviation_['1'] + 1;
            $document_abbreviation_new = sprintf($this->data_name_doc[$document_type] . '%03d', $document_abbreviation);
        } else {
            $document_abbreviation_new = sprintf($this->data_name_doc[$document_type] . '%03d', $document_abbreviation['document_abbreviation'] + 1);
        }
        $data = [
            'document_type' => $document_type,
            'document_abbreviation' => $document_abbreviation_new,
            'name_th' => $this->request->getVar('name_th'),
            'name_eng' => $this->request->getVar('name_eng'),
            'secret_level' => $this->request->getVar('secret_level'),
            'create_update_upload' => implode(',', $this->request->getPost('tags_create')),
            'review' => implode(',', $this->request->getPost('tags_review')),
            'approval' => implode(',', $this->request->getPost('tags_approve')),
            'status' => 1,
            'version' => 'v.0.0.1',
            'creation_time' => date('Y-m-d H:i:s'),
            'created_by' => session()->get('name') . ' ' . session()->get('lastname'),
            'last_modified_time' => date('Y-m-d H:i:s'),
            'last_modified_by' => session()->get('name') . ' ' . session()->get('lastname'),
            'id_file' => $id_file,
            'id_version' => $id_version,
        ];

        $Support_DocumentedModels->insert($data);
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Create Documented',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Create Documented',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //get created data document
    public function get_data_documented_create($id_version = null)
    {
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $UserModels = new UserModels();
        $totalRecords = $Support_DocumentedModels->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Support_DocumentedModels->groupStart()
                ->like('document_type', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                // ->orLike('effect', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $data = $Support_DocumentedModels->where('id_version', $id_version)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            if ($value['id_file'] != null) {
                $file = $FileModels->where('id_files', $value['id_file'])->first();
                $data[$key]['id_file'] = $file;
            }

            if ($value['create_update_upload'] != null) {
                $id_users = explode(',', $value['create_update_upload']);
                $users = $UserModels->whereIn('id_user', $id_users)
                    ->select(['name_user', 'lastname_user'])
                    ->findAll();
                $data[$key]['create_update_upload'] = $users;
            }

            if ($value['review'] != null) {
                $id_users = explode(',', $value['review']);
                $users = $UserModels->whereIn('id_user', $id_users)
                    ->select(['name_user', 'lastname_user'])
                    ->findAll();
                $data[$key]['review'] = $users;
            }

            if ($value['approval'] != null) {
                $id_users = explode(',', $value['approval']);
                $users = $UserModels->whereIn('id_user', $id_users)
                    ->select(['name_user', 'lastname_user'])
                    ->findAll();
                $data[$key]['approval'] = $users;
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

    //index edit documented
    public function indexCrudManagementDoc($id_version = null, $num_ver = null, $status_version = null, $id_doc_version = null)
    {
        $RequirementModels = new RequirementModels();
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $UserModels = new UserModels();
        $data['user_data'] = $UserModels->findAll();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 15)->first();
        $data['data_doc'] = $Support_DocumentedModels->where('id_document_create_update ', $id_doc_version)->first();
        $data['data_doc']['id_file'] = $FileModels->where('id_files', $data['data_doc']['id_file'])->first();
        $data['data'] = [
            'id_version' => $id_version,
            'num_ver' => $num_ver,
            'status' => $status_version
        ];
        $my_id = session()->get('id');

        $data['view_mode'] = !in_array($my_id, explode(',', $data['data_doc']['create_update_upload']));
        echo view('layout/header');
        echo view('Support/CRUD_Management_Doc', $data);
    }

    //index View documented
    public function indexCrudManagementDoc_View($id_version = null, $num_ver = null, $status_version = null, $id_doc_version = null)
    {
        $RequirementModels = new RequirementModels();
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $UserModels = new UserModels();
        $data['user_data'] = $UserModels->findAll();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 15)->first();
        $data['data_doc'] = $Support_DocumentedModels->where('id_document_create_update ', $id_doc_version)->first();
        $data['data_doc']['id_file'] = $FileModels->where('id_files', $data['data_doc']['id_file'])->first();
        $data['data'] = [
            'id_version' => $id_version,
            'num_ver' => $num_ver,
            'status' => $status_version
        ];
        $data['view_mode'] = true;
        echo view('layout/header');
        echo view('Support/CRUD_Management_Doc', $data);
    }

    //edit documented
    public function edit_documented($id_doc_version = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        helper('filesystem');
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();

        $document_type = $this->request->getVar('document_type');
        $document_type_old = $this->request->getVar('document_type_old');
        $document_abbreviation_old = $this->request->getVar('document_abbreviation_old');

        if ($document_type != $document_type_old) {
            $document_abbreviation = $Support_DocumentedModels->where('id_version', $id_version)->where('document_type', $document_type)->selectMax('document_abbreviation')->first();
            if ($document_abbreviation != null) {
                $document_abbreviation_ = explode('_', $document_abbreviation['document_abbreviation']);
                $document_abbreviation = $document_abbreviation_['1'] + 1;
                $document_abbreviation_old = sprintf($this->data_name_doc[$document_type] . '%03d', $document_abbreviation);
            } else {
                $document_abbreviation_old = sprintf($this->data_name_doc[$document_type] . '%03d', $document_abbreviation + 1);
            }
        }

        $id_file = $this->request->getVar('id_file_old');
        $file = $this->request->getFile('doc-file');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();
            if ($id_file != null) {
                $del_path = 'public/uploads/' . $id_file . '/'; // For Delete folder
                $check_de_file = delete_files($del_path, false); // Delete files into the folder
                if (!$check_de_file) {
                    $response = [
                        'success' => false,
                        'message' => 'Unable to add new files!',
                    ];
                    return $this->response->setJSON($response);
                } else {
                    $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
                    $file_update = [
                        'name_file' => $newName,
                    ];
                    $FileModels->update($id_file, $file_update);
                }
            } else {
                $FileModels->insert([
                    'name_file' => $newName,
                ]);
                $id_file = $FileModels->insertID();
                $file->move(ROOTPATH . 'public/uploads/' . $id_file, $newName);
            }
        }

        $data = [
            'document_type' => $document_type,
            'document_abbreviation' => $document_abbreviation_old,
            'name_th' => $this->request->getVar('name_th'),
            'name_eng' => $this->request->getVar('name_eng'),
            'secret_level' => $this->request->getVar('secret_level'),
            'status' => 1,
            'version' => $this->update_version($this->request->getVar('version'), 'edit'),
            'last_modified_time' => date('Y-m-d H:i:s'),
            'last_modified_by' => session()->get('name') . ' ' . session()->get('lastname'),
            'id_file' => $id_file,
            'id_version' => $id_version,
            'create_update_upload' => implode(',', $this->request->getPost('tags_create')),
            'review' => implode(',', $this->request->getPost('tags_review')),
            'approval' => implode(',', $this->request->getPost('tags_approve')),
        ];

        $Support_DocumentedModels->update($id_doc_version, $data);
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Documented',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Edit Documented',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //update status documented
    public function update_status_documented($id_doc_version = null, $id_version = null, $status_version = null, $status = null)
    {
        helper(['form']);
        $Support_DocumentedModels = new Support_DocumentedModels();
        if ($status == 2) {
            $Support_DocumentedModels->update($id_doc_version, ['status' => $status]);
        } else if ($status == 3) {
            $Support_DocumentedModels->update($id_doc_version, ['status' => $status, 'rejection_details' => $this->request->getVar('text_request_modify')]);
        } else if ($status == 6) {
            $Support_DocumentedModels->update($id_doc_version, ['status' => $status, 'request_details' => $this->request->getVar('text_request_modify')]);
        } else if ($status == 4) {
            $Support_DocumentedModels->update($id_doc_version, [
                'status' => $status,
                'version' => $this->update_version($this->request->getVar('version'), 'review'),
                'review_time' => date('Y-m-d H:i:s'),
                'review_by' => session()->get('name') . ' ' . session()->get('lastname'),
            ]);
        } else if ($status == 5) {
            $Support_DocumentedModels->update($id_doc_version, [
                'status' => $status,
                'version' => $this->update_version($this->request->getVar('version'), 'approval'),
                'approval_time' => date('Y-m-d H:i:s'),
                'approver_by' => session()->get('name') . ' ' . session()->get('lastname'),
            ]);
        }

        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Update Status Documented',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Update Status Documented',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }
    //get management data document
    public function get_data_documented_management($id_version = null)
    {
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $my_id_user = session()->get('id');

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Support_DocumentedModels->groupStart()
                ->like('document_type', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                // ->orLike('effect', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $totalRecords = $Support_DocumentedModels->where('id_version', $id_version)
            ->groupStart()
            ->where("FIND_IN_SET('$my_id_user', create_update_upload) >", 0)
            ->orWhere('create_update_upload', $my_id_user)
            ->orWhere("FIND_IN_SET('$my_id_user', review) >", 0)
            ->orWhere('review', $my_id_user)
            ->orWhere("FIND_IN_SET('$my_id_user', approval) >", 0)
            ->orWhere('approval', $my_id_user)
            ->groupEnd()
            ->countAllResults();

        if (!empty($searchValue)) {
            $Support_DocumentedModels->groupStart()
                ->like('document_type', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                // ->orLike('effect', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }
        $filteredData = $Support_DocumentedModels->where('id_version', $id_version)
            ->groupStart()
            ->where("FIND_IN_SET('$my_id_user', create_update_upload) >", 0)
            ->orWhere('create_update_upload', $my_id_user)
            ->orWhere("FIND_IN_SET('$my_id_user', review) >", 0)
            ->orWhere('review', $my_id_user)
            ->orWhere("FIND_IN_SET('$my_id_user', approval) >", 0)
            ->orWhere('approval', $my_id_user)
            ->groupEnd()
            ->findAll($limit, $start);

        $recordsFiltered = $totalRecords;

        foreach ($filteredData as $key => $value) {
            if ($value['id_file'] != null) {
                $file = $FileModels->where('id_files', $value['id_file'])->first();
                $filteredData[$key]['id_file'] = $file;
            }

            if ($value['create_update_upload'] != null) {
                $id_users = explode(',', $value['create_update_upload']);
                $check_have = in_array($my_id_user, $id_users);
                if ($check_have) {
                    $filteredData[$key]['create_update_upload'] = true;
                } else {
                    $filteredData[$key]['create_update_upload'] = false;
                }
            }

            if ($value['review'] != null) {
                $id_users = explode(',', $value['review']);
                $check_have = in_array($my_id_user, $id_users);
                if ($check_have) {
                    $filteredData[$key]['review'] = true;
                } else {
                    $filteredData[$key]['review'] = false;
                }
            }

            if ($value['approval'] != null) {
                $id_users = explode(',', $value['approval']);
                $check_have = in_array($my_id_user, $id_users);
                if ($check_have) {
                    $filteredData[$key]['approval'] = true;
                } else {
                    $filteredData[$key]['approval'] = false;
                }
            }
        }
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $filteredData,
            'searchValue' => $searchValue,
            'id_version' => $id_version
        ];

        return $this->response->setJSON($response);
    }

    //index edit documented approved
    public function indexCrudControl($id_version = null, $num_ver = null, $status_version = null, $id_doc_version = null)
    {
        $RequirementModels = new RequirementModels();
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 15)->first();
        $data['data_doc'] = $Support_DocumentedModels->where('id_document_create_update ', $id_doc_version)->first();
        $data['data_doc']['id_file'] = $FileModels->where('id_files', $data['data_doc']['id_file'])->first();
        $data['data'] = [
            'id_version' => $id_version,
            'num_ver' => $num_ver,
            'status' => $status_version
        ];
        $data['edit_mode'] = '';
        echo view('layout/header');
        echo view('Support/CRUD_Control', $data);
    }

    //index view documented approved
    public function indexViewControl($id_version = null, $num_ver = null, $status_version = null, $id_doc_version = null)
    {
        $RequirementModels = new RequirementModels();
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 15)->first();
        $data['data_doc'] = $Support_DocumentedModels->where('id_document_create_update ', $id_doc_version)->first();
        $data['data_doc']['id_file'] = $FileModels->where('id_files', $data['data_doc']['id_file'])->first();
        $data['data'] = [
            'id_version' => $id_version,
            'num_ver' => $num_ver,
            'status' => $status_version
        ];
        $data['edit_mode'] = 'disabled';
        echo view('layout/header');
        echo view('Support/CRUD_Control', $data);
    }

    //get data documented approved
    public function get_data_documented_approved($id_version = null)
    {
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        $UserModels = new UserModels();
        $totalRecords = $Support_DocumentedModels->where('id_version', $id_version)->where('status', 5)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $Support_DocumentedModels->groupStart()
                ->like('document_type', $searchValue) // แทน 'column1', 'column2', ... ด้วยชื่อคอลัมน์ที่คุณต้องการค้นหา
                // ->orLike('effect', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมตามที่ต้องการค้นหา
                ->groupEnd();
        }

        $recordsFiltered = $totalRecords;
        $data = $Support_DocumentedModels->where('id_version', $id_version)->where('status', 5)->findAll($limit, $start);

        foreach ($data as $key => $value) {
            if ($value['id_file'] != null) {
                $file = $FileModels->where('id_files', $value['id_file'])->first();
                $data[$key]['id_file'] = $file;
            }

            if ($value['create_update_upload'] != null) {
                $id_users = explode(',', $value['create_update_upload']);
                $users = $UserModels->whereIn('id_user', $id_users)
                    ->select(['name_user', 'lastname_user'])
                    ->findAll();
                $data[$key]['create_update_upload'] = $users;
            }

            if ($value['review'] != null) {
                $id_users = explode(',', $value['review']);
                $users = $UserModels->whereIn('id_user', $id_users)
                    ->select(['name_user', 'lastname_user'])
                    ->findAll();
                $data[$key]['review'] = $users;
            }

            if ($value['approval'] != null) {
                $id_users = explode(',', $value['approval']);
                $users = $UserModels->whereIn('id_user', $id_users)
                    ->select(['name_user', 'lastname_user'])
                    ->findAll();
                $data[$key]['approval'] = $users;
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

    //edit documented approved
    public function edit_documented_approved($id_doc_version = null, $id_version = null, $status_version = null)
    {
        helper(['form']);
        $Support_DocumentedModels = new Support_DocumentedModels();

        $data = [
            'document_owner' => $this->request->getVar('docown'),
            'release_date' => $this->request->getVar('releasedate'),
        ];
        $Support_DocumentedModels->update($id_doc_version, $data);
        $TimelineModels = new TimelineModels();
        $data_log = [
            'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Edit Documented Control',
            'type_timeline' => 1,
            'status_id' => $status_version,
            'id_note' => null,
            'id_user' => session()->get('id'),
            'id_version' => $id_version,
        ];
        $TimelineModels->save($data_log);
        $response = [
            'success' => true,
            'message' => 'Successfully Edit Documented Control',
            'reload' => true,
        ];
        return $this->response->setJSON($response);
    }

    //delete documented
    public function delete_documented($id_doc_version = null,  $id_version = null, $status_version = null)
    {
        $Support_DocumentedModels = new Support_DocumentedModels();
        $FileModels = new FileModels();
        helper('filesystem');

        $id_file = $Support_DocumentedModels->where('id_document_create_update', $id_doc_version)->select('id_file')->first();
        $idfile = $id_file['id_file'];
        if ($idfile) {
            $FileModels = new FileModels();
            $FileModels->where('id_files ', $idfile)->delete($idfile);
            $del_path = 'public/uploads/' . $idfile . '/'; // For Delete folder

            $check1 = delete_files($del_path, true); // Delete files into the folder
            $check2 = rmdir($del_path);
            if (!$check1) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete file!',
                ];
                return $this->response->setJSON($response);
            }
            if (!$check2) {
                $response = [
                    'success' => false,
                    'message' => 'Unable to delete folder file!',
                ];
                return $this->response->setJSON($response);
            }
        }
        $check = $Support_DocumentedModels->where('id_document_create_update', $id_doc_version)->delete($id_doc_version);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to delete Documented',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Delete Documented',
                'type_timeline' => 1,
                'status_id' => $status_version,
                'id_note' => null,
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Successfully deleted Documented',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    private function update_version($version = null, $action = null)
    {
        $version_split = explode('.', $version);
        if ($action == 'edit') {
            $version_split[3] = $version_split[3] + 1;
        } else if ($action == 'review') {
            $version_split[2] = $version_split[2] + 1;
        } else if ($action == 'approval') {
            $version_split[1] = $version_split[1] + 1;
        }
        $version_ = implode('.', $version_split);

        return $version_;
    }
}
