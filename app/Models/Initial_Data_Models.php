<?php

namespace App\Models;

use CodeIgniter\Model;

class Initial_Data_Models extends Model
{
    protected $table = 'initial_data';

    protected $primaryKey = 'id_initial_data';

    protected $allowedFields = ['id_audit_plan', 'audit_objective', 'audit_scope', 'audit_criteria', 'audit_lead', 'audit_team', 'attach_file_audit_plan'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_initial_data' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_initial_data);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}