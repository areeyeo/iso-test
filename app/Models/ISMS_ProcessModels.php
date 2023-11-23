<?php

namespace App\Models;

use CodeIgniter\Model;

class ISMS_ProcessModels extends Model
{
    protected $table = 'isms_process_table';

    protected $primaryKey = 'id_isms_process';

    protected $allowedFields = ['id_file', 'date_upload', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_isms_process' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_isms_process);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
