<?php

namespace App\Models;

use CodeIgniter\Model;

class Internal_issuesModels extends Model
{
    protected $table = 'internal_issues_table';

    protected $primaryKey = 'id_internal_issues';

    protected $allowedFields = ['topic' , 'description' , 'activated'];

    public function getData_table($id_internal_issues , $standard) {
        $builder = $this->db->table($this->table);
        $builder->select('* , GROUP_CONCAT(internal_issues_table.activated) AS activated_issu , GROUP_CONCAT(internal_issuses_description_table.activated) AS activated_des , GROUP_CONCAT(internal_issuses_description_table.details) AS details_des , GROUP_CONCAT(internal_issuses_description_table.id_interl_issuses_description ) AS id , 1 AS check ');
        $builder->join('internal_issuses_description_table', 'internal_issues_table.id_internal_issues = internal_issuses_description_table.id_interl_issuses');
        $builder->join('standard_table', 'internal_issuses_description_table.standard_number = standard_table.id_standard ');
        $builder->where('internal_issuses_description_table.id_interl_issuses', $id_internal_issues);
        $builder->where('internal_issuses_description_table.standard_number', $standard);
        $builder->groupBy('internal_issuses_description_table.id_interl_issuses_description');

        $query = $builder->get();
        return $query->getResult();
    }

    public function getData(){
        $builder = $this->db->table($this->table);
        $query = $builder->select('*, (id_internal_issues) AS id_select');
        $query = $builder->get();
        return $query->getResult();
    }
}
