@extends('adminlte::page')

@section('title', 'Laporan Harian')

@section('content_header')

    <h1>Laporan Harian</h1>

@stop
@section('css')
<link rel="stylesheet" href="../vendor/daterangepicker/daterangepicker.css">
@stop

@section('content')
   <div class="row">
    <div class="col-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Date picker</h3>
        </div>
        <div class="card-body">
          <!-- Date range -->
          <div class="form-group">
            <label>Date range:</label>

            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
              </div>
              <input type="text" class="form-control float-right" id="reservation">
            </div>
            <!-- /.input group -->
          </div>
          <!-- /.form group -->
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="col-12">
      <div class="card">
    
        <div class="card-header">
          <h3 class="card-title">Laporan Harian Tanggal 

            {{$reportharian[0]->dtreport}}
          </h3>

        </div>
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
              <?php 
                $total_target_pbt = 0;
                $total_target_shat = 0;
                $total_target_k4 = 0;
                $total_terukur = 0;
                $total_tergambar = 0;
                $total_k4 = 0;
                $total_pemberkasan = 0;
                $total_aplikasi_fisik_pbt = 0;
                $total_aplikasi_fisik_k4 = 0;
                $total_aplikasi_fisik_yuridis = 0;
              ?>
                @if(count($reportharian) > 0)
                @foreach ($reportharian as $row)
              <tr>
                <td>{{$row->project_location->kotakab->name}}</td>
                <td>{{$row->project_location->kecamatan->name}}</td>
                <td>{{$row->project_location->desa->name}}</td>
                <td>{{$row->project_location->target_pbt}}
                  <?php 
                  $total_target_pbt += $row->project_location->target_pbt;
                  ?>
                </td>
                <td>{{$row->project_location->target_shat}}
                  <?php 
                  $total_target_shat += $row->project_location->target_shat;
                  ?>
                </td>
                <td>{{$row->project_location->target_k4}}
                  <?php 
                  $total_target_k4 += $row->project_location->target_k4;
                  ?>
                </td>
                <td>{{$row->project_location->user->pelaksana}}</td>
                <td>{{$row->project_location->tim}}</td>
                <td>{{$row->terukur}}
                  <?php 
                  $total_terukur += $row->terukur;
                  ?>
                </td>
                <td>{{$row->tergambar}}
                  <?php 
                  $total_tergambar += $row->tergambar;
                  ?>
                </td>
                <td>{{$row->k4}}
                  <?php 
                  $total_k4 += $row->k4;
                  ?>
                </td>
                <td>{{$row->pemberkasan}}
                  <?php 
                  $total_pemberkasan += $row->pemberkasan;
                  ?>
                </td>
                <td>{{$row->aplikasi_fisik_pbt}}
                  <?php 
                  $total_aplikasi_fisik_pbt += $row->aplikasi_fisik_pbt;
                  ?>
                </td>
                <td>{{$row->aplikasi_fisik_k4}}
                  <?php 
                  $total_aplikasi_fisik_k4 += $row->aplikasi_fisik_k4;
                  ?>
                </td>
                <td>{{$row->aplikasi_fisik_yuridis}}
                  <?php 
                  $total_aplikasi_fisik_yuridis += $row->aplikasi_fisik_yuridis;
                  ?>
                </td>
                <td>{{$row->keterangan}}</td>
              </tr>
              @endforeach
              @else
              <td colspan="17" style="text-align:center">Belum ada Laporan hari ini</td>
              @endif
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3" style="text-align:center">TOTAL</th>
                <th>{{$total_target_pbt}}</th>
                <th>{{$total_target_shat}}</th>
                <th>{{$total_target_k4}}</th>
                <th>-</th>
                <th>-</th>
                <th>{{$total_terukur}}</th>
                <th>{{$total_tergambar}}</th>
                <th>{{$total_k4}}</th>
                <th>{{$total_pemberkasan}}</th>
                <th>{{$total_aplikasi_fisik_yuridis}}</th>
                <th>{{$total_aplikasi_fisik_k4}}</th>
                <th>{{$total_aplikasi_fisik_yuridis}}</th>
                <th>-</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@stop

@section('js')
<script src="../vendor/moment/moment.min.js"></script>
<script src="../vendor/daterangepicker/daterangepicker.js"></script>
<script> console.log('Hi!'); 
    //Date range picker with time picker
    $('#reservation').daterangepicker({
      timePickerIncrement: 30,
      locale: {
        format: 'DD/MM/YYYY'
      }
    })
</script>
@stop
