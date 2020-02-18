@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1>Laporan Hari Ini</h1>

@stop

@section('css')
   {{--  <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('content')
   <div class="row">
    <div class="col-12">
      <div class="card">
       {{--  <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

        </div> --}}
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-bordered text-nowrap">
            <thead>
              <tr>
                <th colspan="3" style="text-align:center">LOKASI</th>
                <th colspan="3" style="text-align:center">TARGET</th>
                <th colspan="2" style="vertical-align : middle; text-align:center">PELAKSANA</th>
                <th colspan="10" style="text-align:center">REALISASI</th>
              </tr>
              <tr>
                <th>Kota/Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>PBT</th>
                <th>SHAT</th>
                <th>K4</th>
                <th style="text-align:center">Nama</th>
                <th>Tim</th>
                <th>Terukur</th>
                <th>Tergambar</th>
                <th>K4</th>
                <th>Pemberkasan</th>
                <th>Aplikasi Fisik PBT</th>
                <th>Aplikasi Fisik K4</th>
                <th>Aplikasi Fisik Yuridis</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($reportharian as $row)
              <tr>
                <td>{{$row->project_location->kotakab->name}}</td>
                <td>{{$row->project_location->kecamatan->name}}</td>
                <td>{{$row->project_location->desa->name}}</td>
                <td>{{$row->project_location->target_pbt}}</td>
                <td>{{$row->project_location->target_shat}}</td>
                <td>{{$row->project_location->target_k4}}</td>
                <td>{{$row->project_location->user->pelaksana}}</td>
                <td>{{$row->project_location->tim}}</td>
                <td>{{$row->terukur}}</td>
                <td>{{$row->tergambar}}</td>
                <td>{{$row->k4}}</td>
                <td>{{$row->pemberkasan}}</td>
                <td>{{$row->aplikasi_fisik_pbt}}</td>
                <td>{{$row->aplikasi_fisik_k4}}</td>
                <td>{{$row->aplikasi_fisik_yuridis}}</td>
                <td>{{$row->keterangan}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
