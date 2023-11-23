<?php

namespace App\Controllers;

use App\Models\ActivitesLogModels;
use App\Models\UserModels;

class ActivitesLogController extends BaseController
{
    public function index()
    {
        $usermodel = new UserModels();

        $data['user_data'] = $usermodel->findAll();

        echo view('layout/header');
        echo view('Database/logActivites_list', $data);
    }

    public function getDatalog($category = null, $user_id = null, $date_search = null)
    {
        // สร้างอินสแตนซ์ของโมเดล ActivitesLogModels
        $activitesLogModel = new ActivitesLogModels();
        $formattedDate = "0";
        if ($date_search !== '0') {
            $timestampMillis = $date_search;
            $timestampSeconds = $timestampMillis / 1000; // Convert to seconds
            $newTimestampSeconds = $timestampSeconds + 86400; // Add 1 day in seconds
            $formattedDate = date('Y-m-d', $newTimestampSeconds);
        }


        if ($category === '0' && $user_id === '0' && $date_search === '0') {
            $totalRecords = $activitesLogModel->countAllResults();
        } elseif ($category !== '0' && $user_id === '0' && $date_search === '0') {
            $totalRecords = $activitesLogModel->where('type_activities', $category)->countAllResults(); //--ค้นหาด้วยประเภท
        } elseif ($category === '0' && $user_id !== '0' && $date_search === '0') {
            $totalRecords = $activitesLogModel->where('id_user', $user_id)->countAllResults(); //--ค้นหาด้วยไอดีผู้ใช้
        } elseif ($category === '0' && $user_id === '0' && $date_search !== '0') {
            $totalRecords = $activitesLogModel->where('date_activites', $formattedDate)->countAllResults(); //--ค้นหาด้วยวันที่
        } elseif ($category !== '0' && $user_id !== '0' && $date_search === '0') {
            $totalRecords = $activitesLogModel
                ->where('type_activities', $category)
                ->where('id_user', $user_id)
                ->countAllResults();
        } elseif ($category !== '0' && $user_id === '0' && $date_search !== '0') {
            $totalRecords = $activitesLogModel
                ->where('type_activities', $category)
                ->where('date_activites', $formattedDate)
                ->countAllResults();
        } elseif ($category === '0' && $user_id !== '0' && $date_search !== '0') {
            $totalRecords = $activitesLogModel
                ->where('id_user', $user_id)
                ->where('date_activites', $formattedDate)
                ->countAllResults();
        } elseif ($category !== '0' && $user_id !== '0' && $date_search !== '0') {
            $totalRecords = $activitesLogModel
                ->where('type_activities', $category)
                ->where('id_user', $user_id)
                ->where('date_activites', $formattedDate)
                ->countAllResults();
        }

        // ดึงข้อมูลการกระทำที่ต้องการแสดงผล
        $limit = $this->request->getVar('length');
        $start = $this->request->getVar('start');
        $draw = $this->request->getVar('draw');

        $searchValue = $this->request->getVar('search')['value'];

        if (!empty($searchValue)) {
            $activitesLogModel->groupStart()
                ->like('text_activities', $searchValue)
                ->orLike('date_activites', $searchValue)
                // เพิ่มคอลัมน์เพิ่มเติมที่ต้องการค้นหา
                ->groupEnd();
        }

        // นับจำนวนรายการที่ผ่านการกรองด้วยการค้นหา
        $recordsFiltered = $totalRecords;

        if ($category === '0' && $user_id === '0' && $date_search === '0') {
            $data = $activitesLogModel->findAll($limit, $start);
        } elseif ($category !== '0' && $user_id === '0' && $date_search === '0') {
            $data = $activitesLogModel->where('type_activities', $category)->findAll($limit, $start); //--ค้นหาด้วยประเภท
        } elseif ($category === '0' && $user_id !== '0' && $date_search === '0') {
            $data = $activitesLogModel->where('id_user', $user_id)->findAll($limit, $start); //--ค้นหาด้วยไอดีผู้ใช้
        } elseif ($category === '0' && $user_id === '0' && $date_search !== '0') {
            $data = $activitesLogModel->where('date_activites', $formattedDate)->findAll($limit, $start); //--ค้นหาด้วยวันที่
        } elseif ($category !== '0' && $user_id !== '0' && $date_search === '0') {
            $data = $activitesLogModel
                ->where('type_activities', $category)
                ->where('id_user', $user_id)
                ->findAll($limit, $start);
        } elseif ($category !== '0' && $user_id === '0' && $date_search !== '0') {
            $data = $activitesLogModel
                ->where('type_activities', $category)
                ->where('date_activites', $formattedDate)
                ->findAll($limit, $start);
        } elseif ($category === '0' && $user_id !== '0' && $date_search !== '0') {
            $data = $activitesLogModel
                ->where('id_user', $user_id)
                ->where('date_activites', $formattedDate)
                ->findAll($limit, $start);
        } elseif ($category !== '0' && $user_id !== '0' && $date_search !== '0') {
            $data = $activitesLogModel
                ->where('type_activities', $category)
                ->where('id_user', $user_id)
                ->where('date_activites', $formattedDate)
                ->findAll($limit, $start);
        }


        // สร้างข้อมูลที่จะส่งกลับเป็น JSON ในการตอบสนอง
        $response = [
            'draw' => intval($draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'searchValue' => $searchValue,
            'date_search' => $formattedDate
        ];

        // ส่งข้อมูล JSON กลับ
        return $this->response->setJSON($response);
    }

}