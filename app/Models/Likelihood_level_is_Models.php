<?php

namespace App\Models;

use CodeIgniter\Model;

class Likelihood_level_is_Models extends Model
{
    protected $table = 'likelihood_level_is';

    protected $primaryKey = 'id_likelihood_level_is';

    protected $allowedFields = ['likelihood_name', 'likelihood_level', 'description'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_likelihood_level_is' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_likelihood_level_is);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }
}

