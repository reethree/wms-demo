@extends('layout')

@section('content')
<style>
    .table-bordered {
        border: 1px solid #aeaeae;
    }
    .table-bordered, .table-bordered tbody tr td, .table-bordered tbody tr th {
        border: 1px solid #aeaeae;
    }
</style>
    <!--Welcome, {{ Auth::getUser()->name }}-->
    
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ number_format($sor->total,'2',',','.') }}<sup style="font-size: 20px">%</sup></h3>

                    <p>LCL SOR %</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{ route('lcl-report-inout') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $yor->total }}<sup style="font-size: 20px">%</sup></h3>

                    <p>FCL YOR %</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('fcl-report-rekap') }}" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $countfclcont }}</h3>

                    <p>FCL Inventory Real Time</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $countlclmanifest }}</h3>

                    <p>LCL Inventory Real Time</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-bordered table-hover table-striped" style="background: #FFF;">
                <tbody>
                    <tr>
                        <th>TPS ASAL</th>
                        <!--<th>JML CONT (PLP)</th>-->
                        <th>FCL GATE IN BULAN {{strtoupper(date('F Y'))}}</th>
                    </tr>
                    @foreach($countbytps as $key=>$value)
                    <tr>
                        <td>{{ $key }}</td>
                        <!--<td align="center">{{ $value[0] }}</td>-->
                        <td align="center">{{ $value[1] }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>TOTAL</th>
                        <!--<td align="center"><strong>{{ $totcounttpsp }}</strong></td>-->
                        <td align="center"><strong>{{ $totcounttpsg }}</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-bordered table-hover table-striped" style="background: #FFF;">
                <tbody>
                    <tr>
                        <th>TPS ASAL</th>
                        <!--<th>JML CONT (PLP)</th>-->
                        <th>LCL GATE IN BULAN {{strtoupper(date('F Y'))}}</th>
                    </tr>
                    @foreach($countbytpslcl as $key=>$value)
                    <tr>
                        <td>{{ $key }}</td>
                        <!--<td align="center">{{ $value[0] }}</td>-->
                        <td align="center">{{ $value[1] }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>TOTAL</th>
                        <!--<td align="center"><strong>{{ $totcounttpsp }}</strong></td>-->
                        <td align="center"><strong>{{ $totcounttpsglcl }}</strong></td>
                    </tr>
                </tbody>
            </table>           
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-hover table-striped" style="background: #FFF;">
                <tbody>
                    <tr>
                        <th>KODE DOKUMEN</th>
                        <th>JUMLAH DOKUMEN KELUAR FCL BULAN {{strtoupper(date('F Y'))}}</th>
                    </tr>
                    @foreach($countbydoc as $key=>$value)
                    <tr>
                        <th>{{ $key }}</th>
                        <td align="center">{{ $value }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-bordered table-hover table-striped" style="background: #FFF;">
                <tbody>
                    <tr>
                        <th>KODE DOKUMEN</th>
                        <th>JUMLAH DOKUMEN KELUAR LCL BULAN {{strtoupper(date('F Y'))}}</th>
                    </tr>
                    @foreach($countbydoclcl as $key=>$value)
                    <tr>
                        <th>{{ $key }}</th>
                        <td align="center">{{ $value }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
<!--    <div class="row">
    
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Line Chart</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart">
                      <canvas id="lineChart" style="height:250px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Bar Chart</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height:250px"></canvas>
                  </div>
                </div>
            </div>
        </div>
    </div>-->
    
@endsection

@section('custom_js')

<!-- ChartJS 1.0.1 -->
<script src="{{ asset ("/bower_components/AdminLTE/plugins/chartjs/Chart.min.js") }}" type="text/javascript"></script>

<script>
    var key_graph = '{{$key_graph}}';
    var val_graph = '{{$val_graph}}';
    var areaChartData = {
      labels: JSON.parse(key_graph.replace(/&quot;/g,'"')),
      datasets: [
        {
          label: "Digital Goods",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: val_graph
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);    
    
    
    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
//    barChartData.datasets[1].fillColor = "#00a65a";
//    barChartData.datasets[1].strokeColor = "#00a65a";
//    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
    
</script>

@endsection