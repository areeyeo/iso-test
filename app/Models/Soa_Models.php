<?php

namespace App\Models;

use CodeIgniter\Model;

class Soa_Models extends Model
{
    protected $table = 'soa';

    protected $primaryKey = 'id_soa';

    protected $allowedFields = ['sec' , 'control' , 'exclusion', 'justification', 'how_to', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_soa' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_soa);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}
