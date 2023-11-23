<?php

namespace App\Models;

use CodeIgniter\Model;

class internalModels extends Model
{
    protected $table = 'internal_table';

    protected $primaryKey = 'id_internal';

    protected $allowedFields = ['id_internal_issues', 'effect', 'id_file', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_internal' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_internal);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}
