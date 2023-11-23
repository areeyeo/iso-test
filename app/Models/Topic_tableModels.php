<?php

namespace App\Models;

use CodeIgniter\Model;

class Topic_tableModels extends Model
{
    protected $table = 'topic_table';

    protected $primaryKey = 'id_topic';

    protected $allowedFields = ['topic_standard', 'create_id_user' , 'review_id_user', 'approved_id_user'];

}
