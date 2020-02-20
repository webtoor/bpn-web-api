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
                <th>Email</th>
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
              @if(count($user) > 0)
              @foreach ($user as $row)
              <tr>
                <td>{{$row->pelaksana}}</td>
                <td>{{$row->email}}</td>
                <td>{{$row->project_location->kotakab->name}}</td>
                <td>{{$row->project_location->kecamatan->name}}</td>
                <td>{{$row->project_location->desa->name}}</td>
                <td>{{$row->project_location->tim}}</td>
                <td>{{$row->project_location->target_pbt}}</td>
                <td>{{$row->project_location->target_shat}}</td>
                <td>{{$row->project_location->target_k4}}</td>
                <td>
                <button id="verifikasi" type="button" class="btn btn-block btn-primary btn-sm" data-id="{{$row->id}}" data-toggle="modal" data-target="#modal-verify">Check</button>

                </td>
              </tr>
              @endforeach
              @else
              <td colspan="9" style="text-align:center">Belum ada Pelaksana yang harus diverifikasi</td>
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>

  <div class="modal fade" id="modal-verify">
    <div class="modal-dialog modal-sm">
      {!! Form::open([ 'action' => ['HomeController@verifikasi'], 'method' => 'put' ])!!}

      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Verifikasi Pelaksana</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin untuk melakukan Verifikasi pada Pelaksana ini?</p>
          <input type="hidden" name="pelaksana_id" id="pelaksana_id" required>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
          <button type="submit" class="btn btn-primary">YA</button>
        </div>
        {!! Form::close() !!}

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
@stop

@section('js')
<script> 
  $(document).ready(function () {
    console.log('Hi!'); 
    $("button#verifikasi").click(function () {
            var pelaksana_id = $(this).data('id');
            console.log(pelaksana_id)

            $('#pelaksana_id').val(pelaksana_id);
          });
  });
</script>
@stop
