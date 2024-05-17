<?php

namespace App\Controllers;

use App\Models\RequirementModels;

use App\Models\Planning_is_planningModels;
use App\Models\Planning_is_objectivesModels;
use App\Models\FileModels;
use App\Models\AllversionModels;

class Perf_PerformanceEvaluationController extends BaseController
{
    public function index_performance_management()
    {
        $RequirementModels = new RequirementModels();
        $data['data_requirement'] = $RequirementModels->where('id_standard', 2)->first();

        echo view('layout/header');
        echo view('Performance/Perf_PerformanceEvaluation', $data);
    }

    //-- get data planning is objective--//
    public function get_data_planning_is_objective($select_about = null)
    {
        $Planning_is_planningModels = new Planning_is_planningModels();
        $Planning_is_objectivesModels = new Planning_is_objectivesModels();
        $filemodel = new FileModels();


        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');
        $id_version = $this->get_last_version_approved();
        if (empty($id_version)) {
            $response = [
                'draw' => intval($draw),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ];
            return $this->response->setJSON($response);
        }

        $totalRecords = $Planning_is_objectivesModels->where('id_version', $id_version)->countAllResults();
        $recordsFiltered = $totalRecords;

        $data = $Planning_is_objectivesModels->where('id_version', $id_version)->findAll($limit, $start);
        $data_count['count_pass'] = 0;
        $data_count['count_fail'] = 0;
        foreach ($data as $key => $value) {
            if ($select_about == 0) {
                $data_Planning = $Planning_is_planningModels->where('id_objective', $value['id_objective'])->findAll();
            } else if ($select_about == 1) {
                $data_Planning = $Planning_is_planningModels->where('id_objective', $value['id_objective'])->where('evaluation_results', 1)->findAll();
            } else if ($select_about == 2) {
                $data_Planning = $Planning_is_planningModels->where('id_objective', $value['id_objective'])->where('evaluation_results', 2)->findAll();
            }
            foreach ($data_Planning as $key1 => $value1) {
                $data_Planning[$key1]['file_data'] = $filemodel->where('id_files', $value1['file'])->first();
            }

            
            $data_count['count_pass'] += $Planning_is_planningModels->where('id_objective', $value['id_objective'])->where('evaluation_results', 1)->countAllResults();
            $data_count['count_fail'] += $Planning_is_planningModels->where('id_objective', $value['id_objective'])->where('evaluation_results', 2)->countAllResults();
            

            $data[$key]['data_planning'] = $data_Planning;
        }

        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'data_count' => $data_count,
        ];

        return $this->response->setJSON($response);
    }

    //-- edit performance management --//
    public function edit_performance_management($id_planning = null)
    {
        helper(['form']);
        $Planning_is_planningModels = new Planning_is_planningModels();
        $data = [
            'actual' => $this->request->getVar('actual'),
            'criteria' => $this->request->getVar('criteria'),
            'evaluation_results' => $this->request->getVar('evaluation_results'),
        ];

        $check = $Planning_is_planningModels->update($id_planning, $data);
        if ($check == false) {
            $response = [
                'success' => false,
                'message' => 'Unable to update Performance Evaluation!',
            ];
        } else {
            $response = [
                'success' => true,
                'message' => 'Successfully updated Performance Evaluation',
                'reload' => true,
            ];
        }
        return $this->response->setJSON($response);
    }
    //-- get last version approved --//
    public function get_last_version_approved()
    {
        $AllversionModels = new AllversionModels();
        $id_version = $AllversionModels->where('type_version', 10)->where('status', 4)->orderBy('id_version', 'desc')->first();
        if (empty($id_version)) {
            return null;
        } else {
            return $id_version['id_version'];
        }
    }
}
