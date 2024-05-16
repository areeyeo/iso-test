<?php

namespace App\Models;

use CodeIgniter\Model;

class Address_Risk_Context_Models extends Model
{
    protected $table = 'address_risk_context';

    protected $primaryKey = 'id_address_risks_context';

    protected $allowedFields = ['issue', 'consequence', 'likelihood', 'risk_level', 'risk_assessment_level', 'risk_options', 'name_of_risk_treatment_plan', 'risk_treatment_plan', 'evaluation', 'risk_ownner', 'start_date', 'end_date', 'approve', 'rtp_status', 'file', 'consequence_after', 'likelihood_after', 'residual', 'rtp_no', 'id_version', 'status', 'result'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_address_risks_context' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_address_risks_context);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

