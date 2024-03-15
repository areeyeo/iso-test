<?php

namespace App\Models;

use CodeIgniter\Model;

class Consequence_level_item_context_Models extends Model
{
    protected $table = 'consequence_level_item_context';

    protected $primaryKey = 'id_consequence_level_item_context';

    protected $allowedFields = ['id_consequence_level', 'name', 'impact_level', 'description'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_consequence_level_item_context' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_consequence_level_item_context);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

