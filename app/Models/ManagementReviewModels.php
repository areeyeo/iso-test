<?php

namespace App\Models;

use CodeIgniter\Model;

class ManagementReviewModels extends Model
{
    protected $table = 'management_review';

    protected $primaryKey = 'id_management_review';

    protected $allowedFields = ['meeting_id', 'meeting_date' , 'meeting_doc', 'meeting_minutes_doc'];

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
