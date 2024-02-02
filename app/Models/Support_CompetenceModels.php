<?php

namespace App\Models;

use CodeIgniter\Model;

class Support_CompetenceModels extends Model
{
    protected $table = 'support_competence_table';

    protected $primaryKey = 'id_competence';

    protected $allowedFields = ['role', 'id_file', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_competence' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_competence);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
