@extends('adminlte::page')

@section('title', 'Laporan Kumulatif Detail')

@section('content_header')

    <h1></h1>

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
                @if(count($detail) > 0)
                @foreach ($detail as $row)
              <tr>
                <td>{{$row->kotakab->name}}</td>
                <td>{{$row->kecamatan->name}}</td>
                <td>{{$row->desa->name}}</td>
                <td>{{$row->target_pbt}}
                    <?php 
                     $total_target_pbt += $row->target_pbt;  
                     ?>
                </td>
                <td>{{$row->target_shat}}
                    <?php 
                    $total_target_shat += $row->target_shat;  
                    ?>
                </td>
                <td>{{$row->target_k4}}
                    <?php 
                    $total_target_k4 += $row->target_k4;  
                    ?>
                </td>
                <td>{{$row->user->pelaksana}}</td>
                <td>{{$row->tim}}</td>
                <td>
                    <?php $Tterukur = 0;?>
                    @foreach ($row->reportharian as $terukur)
                     <?php 
                        $Tterukur += $terukur->terukur;
                        $total_terukur += $terukur->terukur;
                        ?>
                    @endforeach
                    {{$Tterukur}}
                </td>
                <td>
                    <?php $Ttergambar = 0;?>
                    @foreach ($row->reportharian as $tergambar)
                     <?php 
                     $Ttergambar += $tergambar->tergambar;
                     $total_tergambar += $tergambar->tergambar;

                      ?>
                    @endforeach
                    {{$Ttergambar}}
                </td>             
                <td>
                    <?php $Tk4 = 0;?>
                    @foreach ($row->reportharian as $k4)
                     <?php 
                        $Tk4 += $k4->k4;
                        $total_k4 += $k4->k4;
                      ?>
                    @endforeach
                    {{$Tk4}}
                </td>
                <td>
                    <?php $Tpemberkasan = 0;?>
                    @foreach ($row->reportharian as $pemberkasan)
                     <?php
                      $Tpemberkasan += $pemberkasan->pemberkasan; 
                      $total_pemberkasan += $pemberkasan->pemberkasan;
                      ?>
                    @endforeach
                    {{$Tpemberkasan}}
                </td>
                <td>
                    <?php $Taplikasi_fisik_pbt = 0;?>
                    @foreach ($row->reportharian as $aplikasi_fisik_pbt)
                     <?php
                      $Taplikasi_fisik_pbt += $aplikasi_fisik_pbt->aplikasi_fisik_pbt;
                      $total_aplikasi_fisik_pbt += $aplikasi_fisik_pbt->aplikasi_fisik_pbt;
                      ?>
                    @endforeach
                    {{$Taplikasi_fisik_pbt}}
                </td>
                <td>
                    <?php $Taplikasi_fisik_k4 = 0;?>
                    @foreach ($row->reportharian as $aplikasi_fisik_k4)
                     <?php 
                     $Taplikasi_fisik_k4 += $aplikasi_fisik_k4->aplikasi_fisik_k4;
                     $total_aplikasi_fisik_k4 += $aplikasi_fisik_k4->aplikasi_fisik_k4;
                      ?>
                    @endforeach
                    {{$Taplikasi_fisik_k4}}
                </td>
                <td>
                    <?php $Taplikasi_fisik_yuridis = 0;?>
                    @foreach ($row->reportharian as $aplikasi_fisik_yuridis)
                     <?php
                      $Taplikasi_fisik_yuridis += $aplikasi_fisik_yuridis->aplikasi_fisik_yuridis; 
                      $total_aplikasi_fisik_yuridis += $aplikasi_fisik_yuridis->aplikasi_fisik_yuridis;
                     ?>
                    @endforeach
                    {{$Taplikasi_fisik_yuridis}}
                </td>
              </tr>
              @endforeach
              @else
              <td colspan="17" style="text-align:center">Laporan Masih Kosong</td>
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
    <script> console.log('Hi!'); </script>
@stop
