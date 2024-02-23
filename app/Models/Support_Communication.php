<?php

namespace App\Models;

use CodeIgniter\Model;

class Support_Communication extends Model
{
    protected $table = 'support_communication_table';

    protected $primaryKey = 'id_communication';

    protected $allowedFields = ['what_to_communicate', 'detail', 'communicator', 'communicate_with_whom', 'when_to_communicate', 'how_to_communicate', 'id_file', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_communication' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_communication);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
