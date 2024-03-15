<?php

namespace App\Models;

use CodeIgniter\Model;

class Address_Risk_Opp_Context_Models extends Model
{
    protected $table = 'address_opportunities_context';

    protected $primaryKey = 'id_address_risks_opp_context';

    protected $allowedFields = ['issue', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_address_risks_opp_context' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_address_risks_opp_context);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

