<?php

namespace App\Models;

use CodeIgniter\Model;

class Audit_Report_Models extends Model
{
    protected $table = 'audit_report';

    protected $primaryKey = 'id_audit_report ';

    protected $allowedFields = ['audit_report_no', 'id_audit_plan', 'report_about', 'note','attach_file_audit_checklist'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_audit_report ' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_audit_report );
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}