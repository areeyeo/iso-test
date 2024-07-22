<?php

namespace App\Models;

use CodeIgniter\Model;

class Followup_Opportunity_Models extends Model
{
    protected $table = 'followup_opportunity';

    protected $primaryKey = 'id_opportunity';

    protected $allowedFields = ['id_audit_report', 'non_inconsistent', 'corrective_action', 'responsible_person', 'start_date', 'end_date', 'status', 'annual', 'detail', 'requirements_control'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_opportunity' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_opportunity);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}