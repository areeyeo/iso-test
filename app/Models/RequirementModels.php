<?php

namespace App\Models;

use CodeIgniter\Model;

class RequirementModels extends Model
{
    protected $table = 'requirement_table';

    protected $primaryKey = 'id_standard';

    protected $allowedFields = ['details' , 'topic_standart'];

}
