<?php

namespace App\Models;

use CodeIgniter\Model;

class Note_Models extends Model
{
    protected $table = 'note_table';

    protected $primaryKey = 'id_note';

    protected $allowedFields = ['text', 'id_user' , 'status_id', 'id_version', 'date_modifiend', 'date_create', 'time_create'];

}
