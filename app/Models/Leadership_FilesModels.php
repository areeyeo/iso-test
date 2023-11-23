<?php

namespace App\Models;

use CodeIgniter\Model;

class Leadership_FilesModels extends Model
{
    protected $table = 'leadership_files_table';

    protected $primaryKey = 'id_ls_file';

    protected $allowedFields = ['name_file', 'upload_date', 'id_version'];

}

