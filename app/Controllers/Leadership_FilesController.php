<?php

namespace App\Controllers;

use App\Models\Leadership_FilesModels;

class Leadership_FilesController extends BaseController
{
    public function getdatatable_file($id_version = null)
    {
        $Leadership_FilesModels = new Leadership_FilesModels();
        $totalRecords = $Leadership_FilesModels->where('id_version', $id_version)->countAllResults();

        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $recordsFiltered = $totalRecords;
        $data = $Leadership_FilesModels->where('id_version', $id_version)->findAll($limit, $start);

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];

        return $this->response->setJSON($response);
    }

    public function file_ls_open($id_ls_file = null)
    {
        $Leadership_FilesModels = new Leadership_FilesModels();
        $data['file'] = $Leadership_FilesModels->find($id_ls_file);

        if ($data['file']) {
            $namefile = $data['file']['name_file'];
            $path = 'public/uploads/Leadership/' . $id_ls_file . '/' . $namefile;

            return redirect()->to(base_url($path));
        } else {
            // Handle file not found
            return redirect()->to('error404');
        }
    }

    public function file_ls_create($id_version = null)
    {
        helper(['form']);
        $Leadership_FilesModels = new Leadership_FilesModels();

        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getClientName();

            $Leadership_FilesModels->insert([
                'name_file' => $newName,
                'upload_date' => date("d/m/Y"),
                'id_version' => $id_version,
            ]);
            $id_file = $Leadership_FilesModels->insertID();
            $file->move(ROOTPATH . 'public/uploads/Leadership/' . $id_file, $newName);
            $response = [
                'success' => true,
                'message' => 'Successfully created File!',
                'reload' => true,
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Please select File!',
                'reload' => false,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function file_ls_delete($id_ls_file = null)
    {
        helper('filesystem');
        $Leadership_FilesModels = new Leadership_FilesModels();
        $Leadership_FilesModels->where('id_ls_file', $id_ls_file)->delete($id_ls_file);
        $del_path = 'public/uploads/Leadership/' . $id_ls_file . '/'; // For Delete folder

        delete_files($del_path, true); // Delete files into the folder
        rmdir($del_path); // Delete folder

        $response = [
            'success' => true,
            'message' => 'Deleted File Successfully',
            'reload' => true,
        ];

        return $this->response->setJSON($response);
    }

    public function file_ls_renamefile($id_file = null)
    {
        $Leadership_FilesModels = new Leadership_FilesModels();
        helper('filesystem');
        helper(['form']);
        $newname = $this->request->getvar('namefile');
        $oldname = $this->request->getvar('oldname');
        $parts = explode('.', $oldname);
        // เลือกคำสุดท้าย
        $lastPart = end($parts);
        $old = ROOTPATH . 'public/uploads/Leadership/' . $id_file . '/' . $oldname;
        $new = ROOTPATH . 'public/uploads/Leadership/' . $id_file . '/' . $newname . '.' . $lastPart;
        rename($old, $new);
        $file_update = [
            'name_file' => $newname.'.' . $lastPart,
        ];
        $check = $Leadership_FilesModels->update($id_file, $file_update);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to rename file!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Rename File Successfully',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function file_ls_dowloadfile($id_ls_file = null)
    {
        $Leadership_FilesModels = new Leadership_FilesModels();
        $data['file'] = $Leadership_FilesModels->find($id_ls_file);

        if ($data['file']) {
            $namefile = $data['file']['name_file'];
            $path = 'public/uploads/Leadership/' . $id_ls_file . '/' . $namefile;

            return $this->response->download($path, null);
        } else {
            // Handle file not found
            return redirect()->to('error404');
        }
    }
}