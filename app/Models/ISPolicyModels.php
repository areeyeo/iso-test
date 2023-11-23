<?php

namespace App\Models;

use CodeIgniter\Model;

class ISPolicyModels extends Model
{
    protected $table = 'leadership_policy_table';

    protected $primaryKey = 'id_policy';

    protected $allowedFields = ['id_file', 'date_upload', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_policy' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_policy);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
