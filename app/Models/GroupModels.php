<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModels extends Model
{
    protected $table = 'group';

    protected $primaryKey = 'id_group';

    protected $allowedFields = ['name_group'];

}
