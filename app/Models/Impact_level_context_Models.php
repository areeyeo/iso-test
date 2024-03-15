<?php

namespace App\Models;

use CodeIgniter\Model;

class Impact_level_context_Models extends Model
{
    protected $table = 'impact_level_context';

    protected $primaryKey = 'id_impact_level';

    protected $allowedFields = ['number_level'];

}
