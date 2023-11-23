<?php

namespace App\Models;

use CodeIgniter\Model;

class ExternalModels extends Model
{
    protected $table = 'external_table';

    protected $primaryKey = 'id_external';

    protected $allowedFields = ['id_external_issues', 'effect', 'id_file', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_external' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_external);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

