@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1>Verifikasi Pelaksana</h1>

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
                <th>Pelaksana</th>
                <th>Kota/Kabupaten</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Tim</th>
                <th>Target PBT</th>
                <th>Target SHAT</th>
                <th>Target K4</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($user as $row)
              <tr>
                <td>{{$row->pelaksana}}</td>
                <td>{{$row->project_location->kotakab->name}}</td>
                <td>{{$row->project_location->kecamatan->name}}</td>
                <td>{{$row->project_location->desa->name}}</td>
                <td>{{$row->project_location->tim}}</td>
                <td>{{$row->project_location->target_pbt}}</td>
                <td>{{$row->project_location->target_shat}}</td>
                <td>{{$row->project_location->target_k4}}</td>
                <td>
                  <button type="button" class="btn btn-block btn-primary btn-sm">Check</button>

                </td>
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
