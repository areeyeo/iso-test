<?php

namespace App\Models;

use CodeIgniter\Model;

class InterestedModels extends Model
{
    protected $table = 'interested_table';

    protected $primaryKey = 'id_interested';

    protected $allowedFields = ['id_interested_issues', 'effect', 'id_file', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_interested' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_interested);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
