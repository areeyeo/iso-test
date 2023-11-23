<?php

namespace App\Models;

use CodeIgniter\Model;

class Leadership_ObjectiveModels extends Model
{
    protected $table = 'leadership_is_objective_table';

    protected $primaryKey = 'id_is_objective';

    protected $allowedFields = ['text', 'id_version'];
    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_is_objective' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_is_objective);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}