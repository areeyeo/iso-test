<?php

namespace App\Controllers;

use App\Models\Note_Models;
use App\Models\NoteComment_Models;
use App\Models\TimelineModels;

class NoteController extends BaseController
{
    public function save_note($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Note_Models = new Note_Models();

        $text = $this->request->getVar('text');
        $modifiend_data = $this->request->getVar('modified');
        //$modifiend_data = str_replace('/','-',$modifiend_data);
        //$modifiend_data = strtotime($modifiend_data);
        //$modifiend_data = date('Y-m-d',$modifiend_data);
        $data = [
            'text' => $text,
            'id_user' => session()->get('id'),
            'status_id' => $status_version,
            'id_version' => $id_version,
            'date_modifiend' => $modifiend_data,
        ];
        $check = $Note_Models->save($data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to create note',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Note on modified date ' . $modifiend_data,
                'type_timeline' => 3,
                'status_id' => $status_version,
                'id_note' => $Note_Models->insertID(),
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Confirmed Create note!',
                'reload' => true,
            ];
        }

        return $this->response->setJSON($response);

    }

    public function comment_note($id_note = null,$id_version = null, $type = null ,$num_ver = null)
    {
        helper(['form']);
        $NoteComment_Models = new NoteComment_Models();

        $text = $this->request->getVar('text_c');
        $data = [
            'text' => $text,
            'id_user' => session()->get('id'),
            'id_note' => $id_note,
        ];
        $check = $NoteComment_Models->save($data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to comment note',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Confirmed Commment note!',
                'reload' => true,
            ];
        }

        if ($type == 1) {
            $typeurl = "context_analysis";
        } else if ($type == 2) {
            $typeurl = "interested_party";
        }  else if ($type == 3) {
            $typeurl = "isms_scope";
        } else {

        }

        //return $this->response->setJSON($response);
        return $this->response->redirect(base_url('/context/'.$typeurl.'/timeline_log/'.$id_version.'/'.$type.'/'.$num_ver.''));

    }

    public function update_note($id_version = null, $status_version = null)
    {
        helper(['form']);
        $Note_Models = new Note_Models();

        $id_ = $this->request->getVar('id_');

        $text = $this->request->getVar('text');
        $modifiend_data = $this->request->getVar('modified');
        //$modifiend_data = str_replace('/','-',$modifiend_data);
        //$modifiend_data = strtotime($modifiend_data);
        //$modifiend_data = date('Y-m-d',$modifiend_data);
        $data = [
            'text' => $text,
            'id_user' => session()->get('id'),
            'status_id' => $status_version,
            'id_version' => $id_version,
            'date_modifiend' => $modifiend_data,
        ];
        $check = $Note_Models->update($id_, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to update note',
            ];
        } else {
            $TimelineModels = new TimelineModels();
            $data_log = [
                'text_timeline' => session()->get('name') . ' ' . session()->get('lastname') . ' Note on modified date ' . $modifiend_data,
                'type_timeline' => 3,
                'status_id' => $status_version,
                'id_note' => $Note_Models->insertID(),
                'id_user' => session()->get('id'),
                'id_version' => $id_version,
            ];
            $TimelineModels->save($data_log);
            $response = [
                'success' => true,
                'message' => 'Confirmed Update note!',
                'reload' => true,
            ];
        }

        return $this->response->setJSON($response);

    }

    public function delete_note($id = null)
    {
        helper(['form']);
        $Note_Models = new Note_Models();
        $NoteComment_Models = new NoteComment_Models();

        $comment = $NoteComment_Models->where('id_note', $id)->findAll();

        if ($comment) {
            //$commentid = $comment['id_note_comment'];
            $NoteComment_Models->where('id_note', $id)->delete();
        }
        $check = $Note_Models->where('id_note ', $id)->delete($id);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'ไม่สามารถลบ Note ได้',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'ลบข้อมูล Note สำเร็จ!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    
    public function delete_notecomment($id = null)
    {
        helper(['form']);
        $NoteComment_Models = new NoteComment_Models();
        $check = $NoteComment_Models->where('id_note_comment', $id)->delete($id);

        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'ไม่สามารถลบ Comment ได้',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'ลบ Comment สำเร็จ!',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }

    public function get_note($id_note = null)
    {

        $Note_Models = new Note_Models();
        $data = $Note_Models->where('id_note', $id_note)->first();
        echo json_encode($data);
    }

}