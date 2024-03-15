<?php

namespace App\Models;

use CodeIgniter\Model;

class Consequence_level_context_Models extends Model
{
    protected $table = 'consequence_level_context';

    protected $primaryKey = 'id_consequence_level_context';

    protected $allowedFields = ['consequence_name', 'status'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_consequence_level_context' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_consequence_level_context);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

