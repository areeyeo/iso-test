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
    public function index($id_context = null, $type = null, $num_ver = null)
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
        } else if ($type == '7') {
            $data['url_version'] = "/leadership/commitment/is_objective/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/7";
            $data['text_path'] = "IS Object";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 5)->first();
        } else if ($type == '10') {
            $data['url_version'] = "/planning/isobjective/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/10";
            $data['text_path'] = "Planning IS Objectives";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 9)->first();
        } else if ($type == '12') {
            $data['url_version'] = "/support/competence/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/12";
            $data['text_path'] = "Support Competence";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 12)->first();
        } else if ($type == '13') {
            $data['url_version'] = "/support/awareness/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/13";
            $data['text_path'] = "Support Awareness";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 13)->first();
        } else if ($type == '14') {
            $data['url_version'] = "/support/communication/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/14";
            $data['text_path'] = "Support Communication";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 14)->first();
        } else if ($type == '15') {
            $data['url_version'] = "/planning/planningAddressRisksOpp/context/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/15";
            $data['text_path'] = "RA & RTP Result IS";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 16)->first();
        } else if ($type == '16') {
            $data['url_version'] = "/planning/planningAddressRisksOpp/is/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/16";
            $data['text_path'] = "RA & RTP Result IS";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 16)->first();
        }else if ($type == '17') {
            $data['url_version'] = "/support/documentation/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/17";
            $data['text_path'] = "Documented Information";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 15)->first();
        } else if ($type == '18') {
            $data['url_version'] = "/planning/soa/index/" . $id_context . '/' . $num_ver;
            $data['url_allversion'] = "/context/context_analysis/index/18";
            $data['text_path'] = "SOA";
            $data['data_requirement'] = $RequirementModels->where('id_standard', 16)->first();
        } else {

        }
        $data['num_ver'] = $num_ver;
        echo view('layout/header');
        echo view('timeline', $data);
    }

}