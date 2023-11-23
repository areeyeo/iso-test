<?php

namespace App\Models;

use CodeIgniter\Model;

class Leadership_orgModels extends Model
{
    protected $table = 'leadership_org_table';

    protected $primaryKey = 'id_org';

    protected $allowedFields = ['text', 'id_version'];

}
