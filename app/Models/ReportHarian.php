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
        'kkp',
        'pengukuran',
        'pemetaan',
        'pbt',
        'su',
        'pengumuman',
        'pengesahan',
        'keterangan',
        'dtreport',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
