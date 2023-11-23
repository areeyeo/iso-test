<?php

namespace App\Controllers;

use App\Models\AllversionModels;
use App\Models\UserModels;
use App\Models\TimelineModels;
use App\Models\Note_Models;
use App\Models\NoteComment_Models;
use App\Models\RequirementModels;

class TimelineController extends BaseController
{
    public function index($id_context = null, $type = null ,$num_ver = null)
    {
        $AllversionModels = new AllversionModels();

        $UserModels = new UserModels();
        $TimelineModels = new TimelineModels();
        $NoteModels = new Note_Models();
        $NoteComment_Models = new NoteComment_Models();
        $RequirementModels = new RequirementModels();

        $data['data'] = $AllversionModels->where('id_version', $id_context)->first();

        $data['UserModels'] = $UserModels->findAll();

        $data['TimelineModels'] = $TimelineModels->orderBy('date_timeline', 'DESC')
        ->orderBy('time_timeline', 'DESC') // เปลี่ยน 'your_column_name' เป็นชื่อคอลัมน์ที่คุณต้องการใช้ในการเรียงลำดับ
        ->where('id_version', $id_context)
        ->findAll();
        $data['NoteModels'] = $NoteModels->orderBy('date_create', 'DESC')
        ->orderBy('time_create', 'DESC') // เปลี่ยน 'your_column_name' เป็นชื่อคอลัมน์ที่คุณต้องการใช้ในการเรียงลำดับ
        ->where('id_version', $id_context)
        ->findAll();
        $data['NoteComment'] = $NoteComment_Models->orderBy('date_activites', 'DESC')
        ->orderBy('time_activites', 'DESC')->findAll();

        $data['type'] = $type;
        $data['num_ver'] = $num_ver;
        
        if ($type == '1') {
            $data['url_version'] = "/context/context_analysis/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/1";
            $data['text_path'] = "Context Analysis";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 1)->first();
        } else if ($type == '2') {
            $data['url_version'] = "/context/interested_party/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/interested_party/index/2";
            $data['text_path'] = "Interested Party";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();
        } else if ($type == '3') {
            $data['url_version'] = "/context/isms_scope/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/isms_scope/index/3";
            $data['text_path'] = "ISMS Scope";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 3)->first();
        } else if ($type == '4') {
            $data['url_version'] = "/context/isms_process/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/isms_process/index/4";
            $data['text_path'] = "ISMS Process";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 4)->first();
        }  else if ($type == '7') {
            $data['url_version'] = "/leadership/commitment/is_objective/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/7";
            $data['text_path'] = "IS Object";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 5)->first();
        } else {

        }
        $data['num_ver'] = $num_ver;
        echo view('layout/header');
        echo view('timeline', $data);
    }

}