<?php

namespace App\Models;

use CodeIgniter\Model;

class Risk_options_context_Models extends Model
{
    protected $table = 'risk_options_context';

    protected $primaryKey = 'id_risk_options_context';

    protected $allowedFields = ['options', 'description'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_risk_options_context' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_risk_options_context);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

