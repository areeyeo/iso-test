<?php

namespace App\Models;

use CodeIgniter\Model;

class Planning_is_planningModels extends Model
{
    protected $table = 'planning_is_objectives_planning_table';

    protected $primaryKey = 'id_planning';

    protected $allowedFields = ['id_objective' , 'planning' , 'start_date' , 'end_date' , 'owner' , 'file' , 'id_version', 'status', 'result', 'date_evaluation', 'evaluation_methods', 'actual', 'criteria', 'evaluation_results'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_planning' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_planning);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}
