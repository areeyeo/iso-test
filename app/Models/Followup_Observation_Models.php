<?php

namespace App\Models;

use CodeIgniter\Model;

class Followup_Observation_Models extends Model
{
    protected $table = 'followup_observation';

    protected $primaryKey = 'id_observation';

    protected $allowedFields = ['id_audit_report', 'non_inconsistent', 'corrective_action', 'responsible_person', 'start_date', 'end_date', 'status', 'annual', 'detail', 'requirements_control'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_observation' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_observation);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}