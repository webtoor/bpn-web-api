<?php

namespace App\Exports;

use App\Models\ReportHarian;
use App\Models\KotaKabupaten;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class KumulatifExport implements FromView
{
    public function view(): View
    {
        return view('admin.export.kumulatif-export', [
            'kota' => KotaKabupaten::with(['project_location' => function ($query) {
                $query->with(['user', 'kotakab', 'kecamatan', 'desa', 'reportharian']);
            }])->where('province_id', 32)->get()
        ]);
    }
}