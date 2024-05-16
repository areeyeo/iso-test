<?php

namespace App\Models;

use CodeIgniter\Model;

class Planning_is_objectivesModels extends Model
{
    protected $table = 'planning_is_objectives_objectives_table';

    protected $primaryKey = 'id_objective';

    protected $allowedFields = ['objective' , 'evaluation' , 'id_version', 'obj_no'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_objective' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_objective);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}
