<?php

namespace App\Models;

use CodeIgniter\Model;

class Schedule_Plan_Models extends Model
{
    protected $table = 'schedule_plan';

    protected $primaryKey = 'id_schedule_plan';

    protected $allowedFields = ['id_audit_plan', 'date', 'start_time', 'end_time', 'event_name', 'detail', 'auditee'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_schedule_plan' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_schedule_plan);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}