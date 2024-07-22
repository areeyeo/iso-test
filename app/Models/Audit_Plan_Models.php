<?php

namespace App\Models;

use CodeIgniter\Model;

class Audit_Plan_Models extends Model
{
    protected $table = 'audit_plan';

    protected $primaryKey = 'id_audit_plan';

    protected $allowedFields = ['program_name', 'start_date', 'end_date'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_audit_plan' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_audit_plan);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}