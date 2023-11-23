<?php

namespace App\Models;

use CodeIgniter\Model;

class Interested_issuesModels extends Model
{
    protected $table = 'interested_issues_table';

    protected $primaryKey = 'id_interested_issues  ';

    protected $allowedFields = ['topic' , 'description' , 'activated'];

    public function getData_table($id_interested_party , $standard) {
        $builder = $this->db->table($this->table);
        $builder->select('* , GROUP_CONCAT(interested_issues_table.activated) AS activated_issu , GROUP_CONCAT(interested_party_description_table.activated) AS activated_des , GROUP_CONCAT(interested_party_description_table.details) AS details_des , GROUP_CONCAT(interested_party_description_table.interested_party_description ) AS id , 3 AS check ');
        $builder->join('interested_party_description_table', 'interested_issues_table.id_interested_issues = interested_party_description_table.id_interested_party');
        $builder->join('standard_table', 'interested_party_description_table.standard_number = standard_table.id_standard ');
        $builder->where('interested_party_description_table.id_interested_party', $id_interested_party);
        $builder->where('interested_party_description_table.standard_number', $standard);
        $builder->groupBy('interested_party_description_table.interested_party_description');

        $query = $builder->get();
        return $query->getResult();
    }

    public function getData(){
        $builder = $this->db->table($this->table);
        $query = $builder->select('*, (id_interested_issues) AS id_select');
        $query = $builder->get();
        return $query->getResult();
    }
}
