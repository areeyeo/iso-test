<?php

namespace App\Models;

use CodeIgniter\Model;

class Leadership_ResponsibilitiesModels extends Model
{
    protected $table = 'leadership_responsibilities_table';

    protected $primaryKey = 'id_responsibilities';

    protected $allowedFields = ['roles', 'responsibilities', 'name_lastname', 'id_file', 'id_version'];
    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_responsibilities' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_responsibilities);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}