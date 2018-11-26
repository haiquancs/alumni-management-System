@extends('Web.Layout.home')

@section('content')

    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{route('web.statistics.index')}}">Thống kê, báo
                                    cáo</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- AREA CHART -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Lượt Truy Cập</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="areaChart" style="height:250px"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- DONUT CHART -->
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Công việc</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="pieChart" style="height:250px"></canvas>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col (LEFT) -->
                    <div class="col-md-6">
                        <!-- LINE CHART -->
                        <div class="card card-danger">
                            <div class="card-header" style="background-color: skyblue">
                                <h3 class="card-title">Tin mới trong ngày</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div style="height:389px">
                                    <div id="news" style="height:389px; overflow-x: hidden;overflow-y: scroll;">
                                        @foreach($getNewsDay as $value)
                                            <div class="row" style="padding-bottom: 5px;padding-left: 8px"><div style="background-color: #B9EBEC; border-radius: 4px; width: 95%;  padding: 10px 10px 10px 10px">{{$value}}</div></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Line Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="height:250px"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- BAR CHART -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Bar Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart" style="height:230px"></canvas>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>

                    <!-- /.col (RIGHT) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    {{--<div class="content">--}}
    {{--<!-- Content Header (Page header) -->--}}
    {{--<section class="content-header">--}}
    {{--<div class="container-fluid">--}}
    {{--<div class="row mb-2">--}}
    {{--<div class="col-sm-6">--}}
    {{--<h1>Flot Charts</h1>--}}
    {{--</div>--}}
    {{--<div class="col-sm-6">--}}
    {{--<ol class="breadcrumb float-sm-right">--}}
    {{--<li class="breadcrumb-item"><a href="#">Home</a></li>--}}
    {{--<li class="breadcrumb-item active">Flot</li>--}}
    {{--</ol>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div><!-- /.container-fluid -->--}}
    {{--</section>--}}

    {{--<!-- Main content -->--}}
    {{--<section class="content">--}}
    {{--<div class="container-fluid">--}}
    {{--<div class="row">--}}
    {{--<div class="col-12">--}}
    {{--<!-- interactive chart -->--}}
    {{--<div class="card card-primary card-outline">--}}
    {{--<div class="card-header">--}}
    {{--<h3 class="card-title">--}}
    {{--<i class="fa fa-bar-chart-o"></i>--}}
    {{--Interactive Area Chart--}}
    {{--</h3>--}}

    {{--<div class="card-tools">--}}
    {{--Real time--}}
    {{--<div class="btn-group" id="realtime" data-toggle="btn-toggle">--}}
    {{--<button type="button" class="btn btn-default btn-sm active" data-toggle="on">--}}
    {{--On--}}
    {{--</button>--}}
    {{--<button type="button" class="btn btn-default btn-sm" data-toggle="off">Off--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
    {{--<div id="interactive" style="height: 300px;"></div>--}}
    {{--</div>--}}
    {{--<!-- /.card-body-->--}}
    {{--</div>--}}
    {{--<!-- /.card -->--}}

    {{--</div>--}}
    {{--<!-- /.col -->--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}

    {{--<div class="row">--}}
    {{--<div class="col-md-6">--}}
    {{--<!-- Line chart -->--}}
    {{--<div class="card card-primary card-outline">--}}
    {{--<div class="card-header">--}}
    {{--<h3 class="card-title">--}}
    {{--<i class="fa fa-bar-chart-o"></i>--}}
    {{--Line Chart--}}
    {{--</h3>--}}

    {{--<div class="card-tools">--}}
    {{--<button type="button" class="btn btn-tool" data-widget="collapse"><i--}}
    {{--class="fa fa-minus"></i>--}}
    {{--</button>--}}
    {{--<button type="button" class="btn btn-tool" data-widget="remove"><i--}}
    {{--class="fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
    {{--<div id="line-chart" style="height: 300px;"></div>--}}
    {{--</div>--}}
    {{--<!-- /.card-body-->--}}
    {{--</div>--}}
    {{--<!-- /.card -->--}}

    {{--<!-- Area chart -->--}}
    {{--<div class="card card-primary card-outline">--}}
    {{--<div class="card-header">--}}
    {{--<h3 class="card-title">--}}
    {{--<i class="fa fa-bar-chart-o"></i>--}}
    {{--Area Chart--}}
    {{--</h3>--}}

    {{--<div class="card-tools">--}}
    {{--<button type="button" class="btn btn-tool" data-widget="collapse"><i--}}
    {{--class="fa fa-minus"></i>--}}
    {{--</button>--}}
    {{--<button type="button" class="btn btn-tool" data-widget="remove"><i--}}
    {{--class="fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
    {{--<div id="area-chart" style="height: 338px;" class="full-width-chart"></div>--}}
    {{--</div>--}}
    {{--<!-- /.card-body-->--}}
    {{--</div>--}}
    {{--<!-- /.card -->--}}

    {{--</div>--}}
    {{--<!-- /.col -->--}}

    {{--<div class="col-md-6">--}}
    {{--<!-- Bar chart -->--}}
    {{--<div class="card card-primary card-outline">--}}
    {{--<div class="card-header">--}}
    {{--<h3 class="card-title">--}}
    {{--<i class="fa fa-bar-chart-o"></i>--}}
    {{--Bar Chart--}}
    {{--</h3>--}}

    {{--<div class="card-tools">--}}
    {{--<button type="button" class="btn btn-tool" data-widget="collapse">--}}
    {{--<i class="fa fa-minus"></i>--}}
    {{--</button>--}}
    {{--<button type="button" class="btn btn-tool" data-widget="remove">--}}
    {{--<i class="fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
    {{--<div id="bar-chart" style="height: 300px;"></div>--}}
    {{--</div>--}}
    {{--<!-- /.card-body-->--}}
    {{--</div>--}}
    {{--<!-- /.card -->--}}

    {{--<!-- Donut chart -->--}}
    {{--<div class="card card-primary card-outline">--}}
    {{--<div class="card-header">--}}
    {{--<h3 class="card-title">--}}
    {{--<i class="fa fa-bar-chart-o"></i>--}}
    {{--Donut Chart--}}
    {{--</h3>--}}

    {{--<div class="card-tools">--}}
    {{--<button type="button" class="btn btn-tool" data-widget="collapse"><i--}}
    {{--class="fa fa-minus"></i>--}}
    {{--</button>--}}
    {{--<button type="button" class="btn btn-tool" data-widget="remove"><i--}}
    {{--class="fa fa-times"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="card-body">--}}
    {{--<div id="donut-chart" style="height: 300px;"></div>--}}
    {{--</div>--}}
    {{--<!-- /.card-body-->--}}
    {{--</div>--}}
    {{--<!-- /.card -->--}}
    {{--</div>--}}
    {{--<!-- /.col -->--}}
    {{--</div>--}}
    {{--<!-- /.row -->--}}
    {{--</div><!-- /.container-fluid -->--}}
    {{--</section>--}}
    {{--<!-- /.content -->--}}
    {{--</div>--}}
    <!-- jQuery -->
    <script src="{{asset('js/alumi/js/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('js/alumi/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{asset('js/alumi/js/Chart.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('js/alumi/js/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('js/alumi/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('js/alumi/js/demo.js')}}"></script>
    {{--<!-- FLOT CHARTS -->--}}
    {{--<script src="{{asset('js/alumi/js/jquery.flot.min.js')}}"></script>--}}
    {{--<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->--}}
    {{--<script src="{{asset('js/alumi/js/jquery.flot.resize.min.js')}}"></script>--}}
    {{--<!-- FLOT PIE PLUGIN - also used to draw donut charts -->--}}
    {{--<script src="{{asset('js/alumi/js/jquery.flot.pie.min.js')}}"></script>--}}
    {{--<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->--}}
    {{--<script src="{{asset('js/alumi/js/jquery.flot.categories.min.js')}}"></script>--}}
    <!-- page script -->

    <script>
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas)

            var areaChartData = {
                labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
                datasets: [
                    {
                        label: 'Electronics',
                        fillColor: 'rgba(210, 214, 222, 1)',
                        strokeColor: 'rgba(210, 214, 222, 1)',
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 40, 0, 0]
                    },
                    {
                        label: 'Digital Goods',
                        fillColor: 'rgba(60,141,188,0.9)',
                        strokeColor: 'rgba(60,141,188,0.8)',
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [100, 60, 220, 400, 350, 700, 500, 900, 500, 400, 400, 900]
                    }
                ]
            }

            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                showScale: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: false,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
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
                {{--legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',--}}
                //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true
            }

            //Create the line chart
            areaChart.Line(areaChartData, areaChartOptions)

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChart = new Chart(lineChartCanvas)
            var lineChartOptions = areaChartOptions
            lineChartOptions.datasetFill = false
            lineChart.Line(areaChartData, lineChartOptions)

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieChart = new Chart(pieChartCanvas)
            var PieData = [
                {
                    value: {{$infoAllListSurvey['job']['un_job']}},
                    color: '#f56954',
                    highlight: '#f56954',
                    label: 'Không có việc'
                },
                {
                    value: {{$infoAllListSurvey['job']['job']}},
                    color: '#00a65a',
                    highlight: '#00a65a',
                    label: 'Có việc'
                }
            ]
            var pieOptions = {
                //Boolean - Whether we should show a stroke on each segment
                segmentShowStroke: true,
                //String - The colour of each segment stroke
                segmentStrokeColor: '#fff',
                //Number - The width of each segment stroke
                segmentStrokeWidth: 2,
                //Number - The percentage of the chart that we cut out of the middle
                percentageInnerCutout: 50, // This is 0 for Pie charts
                //Number - Amount of animation steps
                animationSteps: 100,
                //String - Animation easing effect
                animationEasing: 'easeOutBounce',
                //Boolean - Whether we animate the rotation of the Doughnut
                animateRotate: true,
                //Boolean - Whether we animate scaling the Doughnut from the centre
                animateScale: false,
                //Boolean - whether to make the chart responsive to window resizing
                responsive: true,
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio: true,
                //String - A legend template
                {{--legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'--}}
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            pieChart.Doughnut(PieData, pieOptions)


            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChart = new Chart(barChartCanvas)
            var barChartData = areaChartData
            barChartData.datasets[1].fillColor = '#00a65a'
            barChartData.datasets[1].strokeColor = '#00a65a'
            barChartData.datasets[1].pointColor = '#00a65a'
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: 'rgba(0,0,0,.05)',
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
                {{--legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',--}}
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            }

            barChartOptions.datasetFill = false
            barChart.Bar(barChartData, barChartOptions)
        })
    </script>
    {{--<script src="{{asset('js/app.js')}}"></script>--}}
    {{--<!-- Bootstrap -->--}}
    <script src="{{asset('js/web/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/web/adminlte.js')}}"></script>
    <script src="{{asset('js/web/custom.js')}}"></script>

@endsection