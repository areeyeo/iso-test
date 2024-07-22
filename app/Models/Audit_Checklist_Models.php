<?php

namespace App\Models;

use CodeIgniter\Model;

class Audit_Checklist_Models extends Model
{
    protected $table = 'audit_checklist';

    protected $primaryKey = 'id_audit_checklist';

    protected $allowedFields = ['id_audit_plan', 'inspection_topic', 'attach_file_audit_checklist'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_audit_checklist' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_audit_checklist);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}