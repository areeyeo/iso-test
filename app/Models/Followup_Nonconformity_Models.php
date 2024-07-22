<?php

namespace App\Models;

use CodeIgniter\Model;

class Followup_Nonconformity_Models extends Model
{
    protected $table = 'followup_nonconformity';

    protected $primaryKey = 'id_nonconformity';

    protected $allowedFields = ['id_audit_report', 'nonconformity_issue', 'corrective_action', 'responsible_person', 'start_date', 'end_date', 'status', 'annual', 'level_of_nonconformity', 'detail', 'requirements_control'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_nonconformity' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_nonconformity);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}