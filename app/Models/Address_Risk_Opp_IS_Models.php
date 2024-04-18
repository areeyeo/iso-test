<?php

namespace App\Models;

use CodeIgniter\Model;

class Address_Risk_Opp_IS_Models extends Model
{
    protected $table = 'address_opportunities_is';

    protected $primaryKey = 'id_address_risks_opp_is';

    protected $allowedFields = ['type','asset_group', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_address_risks_opp_is' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_address_risks_opp_is);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

