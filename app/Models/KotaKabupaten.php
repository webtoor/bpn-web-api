<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KotaKabupaten extends Model
{
    protected $table = 'regencies';
    public $timestamps = false;

    public function project_location(){
        return $this->hasMany('App\Models\ProjectLocation', 'kotakab_id', 'id');
    }

}
