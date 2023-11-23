<?php

namespace App\Models;

use CodeIgniter\Model;

class ISMS_ScopeADModels extends Model
{
    protected $table = 'scope_activites_table';

    protected $primaryKey = 'id_scope_activites';

    protected $allowedFields = ['id_file', 'date_upload', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_scope_activites' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_scope_activites);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
