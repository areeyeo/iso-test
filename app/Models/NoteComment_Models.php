<?php

namespace App\Models;

use CodeIgniter\Model;

class NoteComment_Models extends Model
{
    protected $table = 'note_comment_table';

    protected $primaryKey = 'id_note_comment ';

    protected $allowedFields = ['text', 'id_user' , 'date_activites', 'time_activites', 'id_note'];

}
