<?php

namespace App\Models;

use CodeIgniter\Model;

class Address_Risk_Opp_Context_Data_Models extends Model
{
    protected $table = 'address_opportunities_context_data';

    protected $primaryKey = 'id_address_risks_opp_context_data';

    protected $allowedFields = ['id_address_risks_opp_context', 'opportunity_plannings', 'opp_ownner', 'start_date', 'end_date', 'file'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_address_risks_opp_context_data' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_address_risks_opp_context_data);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

