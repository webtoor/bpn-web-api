@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

    <h1>Laporan Harian</h1>

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
                <th rowspan="2"></th>
                <th colspan="3" style="text-align:center">TARGET</th>
                <th colspan="10" style="text-align:center">REALISASI</th>

                
              </tr>
              <tr>
            
                <th>PBT</th>
                <th>SHAT</th>
                <th>K4</th>
                <th>Terukur</th>
                <th>Tergambar</th>
                <th>K4</th>
                <th>Pemberkasan</th>
                <th>Aplikasi Fisik PBT</th>
                <th>Aplikasi Fisik K4</th>
                <th>Aplikasi Fisik Yuridis</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($kota as $row)
              <tr>
                <td>{{$row->name}}</td>
                <td>
                    <?php $target_pbt = 0 ?>
                    @foreach ($row->project_location as $target)
                       <?php $target_pbt += $target->target_pbt?>
                    @endforeach
                    {{$target_pbt}}
                </td>
                <td>
                    <?php $target_shat = 0 ?>
                    @foreach ($row->project_location as $target)
                       <?php $target_shat += $target->target_shat?>
                    @endforeach
                    {{$target_shat}}
                </td>
                <td>
                    <?php $target_k4 = 0 ?>
                    @foreach ($row->project_location as $target)
                       <?php $target_k4 += $target->target_k4?>
                    @endforeach
                    {{$target_k4}}
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
               
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
