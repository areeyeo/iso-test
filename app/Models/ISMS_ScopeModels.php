<?php

namespace App\Models;

use CodeIgniter\Model;

class ISMS_ScopeModels extends Model
{
    protected $table = 'scope_table';

    protected $primaryKey = 'id_scope';

    protected $allowedFields = ['location', 'organization', 'system_service', 'scope_statement','id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_scope' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_scope);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
