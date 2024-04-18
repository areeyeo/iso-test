<?php

namespace App\Models;

use CodeIgniter\Model;

class Consequence_level_is_Models extends Model
{
    protected $table = 'consequence_level_is';

    protected $primaryKey = 'id_consequence_level_is';

    protected $allowedFields = ['consequence_name', 'status'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_consequence_level_is' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_consequence_level_is);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

