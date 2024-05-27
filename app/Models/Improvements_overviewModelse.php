<?php

namespace App\Models;

use CodeIgniter\Model;

class Improvements_overviewModelse extends Model
{
    protected $table = 'improvements_overview';

    protected $primaryKey = 'id_management_review';

    protected $allowedFields = ['improvements_list', 'recorder', 'file'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_management_review' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_management_review);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
