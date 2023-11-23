<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivitesLogModels extends Model
{
    protected $table = 'activities_log';

    protected $primaryKey = 'id_activities';

    protected $allowedFields = ['text_activities', 'type_activities' , 'id_user', 'date_activites'];

}
