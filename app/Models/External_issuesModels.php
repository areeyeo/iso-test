<?php

namespace App\Models;

use CodeIgniter\Model;

class External_issuesModels extends Model
{
    protected $table = 'external_issues_table';

    protected $primaryKey = 'id_external_issues';

    protected $allowedFields = ['topic' , 'description' , 'activated'];

    public function getData_table($id_external_issuses , $standard) {
        $builder = $this->db->table($this->table);
        $builder->select('* , GROUP_CONCAT(external_issues_table.activated) AS activated_issu , GROUP_CONCAT(external_issuses_description_table.activated) AS activated_des , GROUP_CONCAT(external_issuses_description_table.details) AS details_des , GROUP_CONCAT(external_issuses_description_table.id_external_issuses_description) AS id , 2 AS check ');
        $builder->join('external_issuses_description_table', 'external_issues_table.id_external_issues = external_issuses_description_table.id_external_issuses');
        $builder->join('standard_table', 'external_issuses_description_table.standard_number = standard_table.id_standard ');
        $builder->where('external_issuses_description_table.id_external_issuses', $id_external_issuses);
        $builder->where('external_issuses_description_table.standard_number', $standard);
        $builder->groupBy('external_issuses_description_table.id_external_issuses_description');

        $query = $builder->get();
        return $query->getResult();
    }

    public function getData(){
        $builder = $this->db->table($this->table);
        $query = $builder->select('*, (id_external_issues) AS id_select');
        $query = $builder->get();
        return $query->getResult();
    }
}
