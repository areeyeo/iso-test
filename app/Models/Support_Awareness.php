<?php

namespace App\Models;

use CodeIgniter\Model;

class Support_Awareness extends Model
{
    protected $table = 'support_awareness_table';

    protected $primaryKey = 'id_awareness';

    protected $allowedFields = ['course', 'detail', 'date', 'id_file', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_awareness' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_awareness);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
