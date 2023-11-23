<?php

namespace App\Models;

use CodeIgniter\Model;

class AllversionModels extends Model
{
    protected $table = 'all_version_table';

    protected $primaryKey = 'id_version';

    protected $allowedFields = ['modified_date', 'review_date', 'approved_date', 'announce_date', 'status' , 'id_user' , 'type_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_version' => $id]);
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
