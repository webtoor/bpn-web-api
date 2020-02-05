<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectLocation extends Model
{
    protected $table = 'project_location';
    protected $fillable = [
        'user_id',
        'kotakab_id',
        'kecamatan_id',
        'desa_id',
        'tim',
        'target'
    ];
    public $timestamps = true;
}
