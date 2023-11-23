<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModels extends Model
{
    protected $table = 'files_table';

    protected $primaryKey = 'id_files ';

    protected $allowedFields = ['name_file'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_files' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_files);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}
