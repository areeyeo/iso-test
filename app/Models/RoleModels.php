<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModels extends Model
{
    protected $table = 'role';

    protected $primaryKey = 'id_role';

    protected $allowedFields = ['name_role'];

}
