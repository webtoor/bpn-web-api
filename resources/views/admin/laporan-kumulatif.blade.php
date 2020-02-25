@extends('adminlte::page')

@section('title', 'Laporan Kumulatif')

@section('content_header')

    <h1 style="text-align:center">Laporan Kumulatif</h1>

@stop

@section('css')
   {{--  <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('content')
   <div class="row">

    <div class="col-12">
    <a href="{{route('admin-panel.kumulatif-export')}}" class="btn btn-success my-3" target="_blank">EXPORT EXCEL</a>
      <div class="card">
       {{--  <div class="card-header">
          <h3 class="card-title">Responsive Hover Table</h3>

        </div> --}}
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover table-bordered text-nowrap">
            <thead>
              <tr>
                <th rowspan="2" style="vertical-align : middle; text-align:center">LOKASI</th>
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
                @foreach ($kota as $row)
              <tr>
                <td><a href="{{route('admin-panel.laporan-kumulatif-detail', ['kotakab_id' => $row->id])}}">{{$row->name}}</a></td>
                {{-- TARGET PBT --}}
                <td>
                    <?php $target_pbt = 0 ?>
                    @foreach ($row->project_location as $target)
                        <?php 
                        $target_pbt += $target->target_pbt;
                        $total_target_pbt += $target->target_pbt;
                         ?>
                    @endforeach
                    {{$target_pbt}}
                </td>

                {{-- TARGET SHAT --}}

                <td>
                    <?php $target_shat = 0 ?>
                    @foreach ($row->project_location as $target)
                       <?php 
                       $target_shat += $target->target_shat;
                       $total_target_shat += $target->target_shat;
                       ?>
                    @endforeach
                    {{$target_shat}}
                </td>

                {{-- TARGET K4 --}}

                <td>
                    <?php $target_k4 = 0 ?>
                    @foreach ($row->project_location as $target)
                       <?php 
                       $target_k4 += $target->target_k4; 
                       $total_target_k4 += $target->target_k4
                       ?>
                    @endforeach
                    {{$target_k4}}
                </td>

                {{-- TERUKUR --}}
                <td> 

                    <?php $kterukur = 0 ?>
                    @foreach ($row->project_location as $reportterukur)
                    @foreach ($reportterukur->reportharian as $terukur)
                    <?php 
                    $kterukur += $terukur->terukur;
                    $total_terukur += $terukur->terukur;
                     ?>
                    @endforeach
                    @endforeach
                    {{$kterukur}}
                </td>

                {{-- TERGAMBAR --}}

                <td>
                  <?php $ktergambar = 0 ?>
                  @foreach ($row->project_location as $reporttergambar)
                  @foreach ($reporttergambar->reportharian as $tergambar)
                  <?php 
                  $ktergambar += $tergambar->tergambar;
                  $total_tergambar += $tergambar->tergambar;
                  ?>
                  @endforeach
                  @endforeach
                  {{$ktergambar}}
                </td>

               {{-- K4 --}}

                <td>
                  <?php $kk4 = 0 ?>
                  @foreach ($row->project_location as $reportk4)
                  @foreach ($reportk4->reportharian as $k4)
                    <?php 
                    $kk4 += $k4->k4;
                    $total_k4 += $k4->k4; 
                    ?>
                  @endforeach
                  @endforeach
                  {{$kk4}}
                </td>

                {{-- PEMBERKASAN --}}
                <td>
                  <?php $kpemberkasan = 0 ?>
                  @foreach ($row->project_location as $reportpemberkasan)
                  @foreach ($reportpemberkasan->reportharian as $pemberkasan)
                  <?php 
                    $kpemberkasan += $pemberkasan->pemberkasan; 
                    $total_pemberkasan += $pemberkasan->pemberkasan;
                  ?>
                  @endforeach
                  @endforeach
                  {{$kpemberkasan}}
                </td>
                {{-- APLIKASI FISIK PBT --}}
                <td>
                  <?php $kaplikasi_fisik_pbt = 0 ?>
                  @foreach ($row->project_location as $reportaplikasi_fisik_pbt)
                  @foreach ($reportaplikasi_fisik_pbt->reportharian as $aplikasi_fisik_pbt)
                  <?php 
                  $kaplikasi_fisik_pbt += $aplikasi_fisik_pbt->aplikasi_fisik_pbt;
                  $total_aplikasi_fisik_pbt += $aplikasi_fisik_pbt->aplikasi_fisik_pbt;
                  ?>
                  @endforeach
                  @endforeach
                  {{$kaplikasi_fisik_pbt}}
                </td>

                {{-- APLIKASI FISIK SHAT --}}

                <td>
                  <?php $kaplikasi_fisik_k4 = 0 ?>
                  @foreach ($row->project_location as $reportaplikasi_fisik_k4)
                  @foreach ($reportaplikasi_fisik_k4->reportharian as $aplikasi_fisik_k4)
                  <?php 
                  $kaplikasi_fisik_k4 += $aplikasi_fisik_k4->aplikasi_fisik_k4;
                  $total_aplikasi_fisik_k4 += $aplikasi_fisik_k4->aplikasi_fisik_k4;
                   ?>
                  @endforeach
                  @endforeach
                  {{$kaplikasi_fisik_k4}}

                </td>

                {{-- APLIKASI FISIK YURIDIS --}}

                <td>
                  <?php $kaplikasi_fisik_yuridis = 0 ?>
                  @foreach ($row->project_location as $reportaplikasi_fisik_yuridis)
                  @foreach ($reportaplikasi_fisik_yuridis->reportharian as $aplikasi_fisik_yuridis)
                  <?php 
                  $kaplikasi_fisik_yuridis += $aplikasi_fisik_yuridis->aplikasi_fisik_yuridis;
                  $total_aplikasi_fisik_yuridis += $aplikasi_fisik_yuridis->aplikasi_fisik_yuridis;
                  ?>
                  @endforeach
                  @endforeach
                  {{$kaplikasi_fisik_yuridis}}
                </td>
               
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th style="text-align:center">TOTAL</th>
                <th>{{$total_target_pbt}}</th>
                <th>{{$total_target_shat}}</th>
                <th>{{$total_target_k4}}</th>
                <th>{{$total_terukur}}</th>
                <th>{{$total_tergambar}}</th>
                <th>{{$total_k4}}</th>
                <th>{{$total_pemberkasan}}</th>
                <th>{{$total_aplikasi_fisik_pbt}}</th>
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
