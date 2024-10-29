<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadFile extends Model
{
    protected $table = 'uploads_file';

    protected $fillable = [
        'filename',
        'original_filename',
        'file_path',
    ];
}
