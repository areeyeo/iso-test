<?php

namespace App\Models;

use CodeIgniter\Model;

class Risk_level_is_Models extends Model
{
    protected $table = 'risk_level_is';

    protected $primaryKey = 'id_risk_level_is';

    protected $allowedFields = ['risk_level', 'description', 'risk_color', 'text_color', 'minimum', 'maximum', 'risk_assessment_level'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_risk_level_is' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_risk_level_is);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

