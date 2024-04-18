<?php

namespace App\Models;

use CodeIgniter\Model;

class Address_Risk_Opp_IS_Data_Models extends Model
{
    protected $table = 'address_opportunities_is_data';

    protected $primaryKey = 'id_address_risks_opp_is_data';

    protected $allowedFields = ['id_address_risks_opp_is', 'opportunity_plannings', 'opp_ownner', 'start_date', 'end_date', 'file'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_address_risks_opp_is_data' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_address_risks_opp_is_data);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

