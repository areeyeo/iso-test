<?php

namespace App\Models;

use CodeIgniter\Model;

class TimelineModels extends Model
{
    protected $table = 'timeline_log';

    protected $primaryKey = 'id_timeline';

    protected $allowedFields = ['text_timeline' , 'type_timeline' , 'status_id' , 'id_note' , 'id_user' , 'id_version' , 'date_timeline' , 'time_timeline' ];

}
