<?php

namespace App\Models;

use CodeIgniter\Model;

class Support_DocumentedModels extends Model
{
    protected $table = 'support_document_create_update_table';

    protected $primaryKey = 'id_document_create_update';

    protected $allowedFields = ['document_type', 'document_abbreviation', 'name_th', 'name_eng', 'secret_level', 'document_owner', 'create_update_upload', 'review', 'approval', 'status', 'version', 'release_date', 'creation_time', 'created_by', 'last_modified_time', 'last_modified_by', 'review_time', 'review_by', 'approval_time', 'approver_by', 'id_file', 'rejection_details', 'request_details', 'id_version'];

    public function copyDataById($id)
    {
        $query = $this->getWhere(['id_document_create_update' => $id]);
        $row = $query->getRow();

        if ($row) {
            $data = $row;
            unset($data->id_document_create_update);
            $this->insert($data);
            return $this->insertID();
        }
        return null;
    }


}
