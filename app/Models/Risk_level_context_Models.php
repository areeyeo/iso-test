<?php

namespace App\Models;

use CodeIgniter\Model;

class Risk_level_context_Models extends Model
{
    protected $table = 'risk_level_context';

    protected $primaryKey = 'id_risk_level_context';

    protected $allowedFields = ['risk_leve', 'description', 'risk_color', 'text_color', 'minimum', 'maximum', 'risk_assessment_level'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_risk_level_context' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_risk_level_context);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

