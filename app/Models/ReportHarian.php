<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportHarian extends Model
{
    protected $table = 'report_harian';
    protected $fillable = [
        'user_id',
        'project_location_id',
        'terukur',
        'tergambar',
        'k4',
        'pemberkasan',
        'aplikasi_fisik_pbt',
        'aplikasi_fisik_k4',
        'aplikasi_fisik_yuridis',
        'keterangan',
        'dtreport',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;

    public function project_location(){
        return $this->belongsTo('App\Models\ProjectLocation');
    }
}
