@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('pageTitle')
    {{ Auth::user()->id == 1 ? 'Admin - Dashboard' : '- Dashboard' }}
@stop


@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-xl-3 col-md-6 col">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="ion ion-stats-bars"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-number"><small></small></span>
                            <span class="info-box-text">Processing</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3 col-md-6 col">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="ion ion-thumbsdown"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-number"></span>
                            <span class="info-box-text">Cancelled</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-xl-3 col-md-6 col">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="ion ion-bag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-number"></span>
                            <span class="info-box-text">Shipped</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-xl-3 col-md-6 col">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="ion ion-thumbsup"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-number"></span>
                            <span class="info-box-text">Completed</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-md-12 col-xl-8">
                    <!-- AREA CHART -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Area Chart</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="chart">
                                <span style="float: right">
                                    Year :
                                    <select>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                    </select>

                                </span>
                                <canvas id="areaChart" style="height:400px"></canvas>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-12 col-xl-4">

                    <div class="row">

                        <div class="box">
                            <div class="box-body bg-blue">
                                <div class="flexbox mb-20">
                                    <h6 class="text-uppercase text-white">Today</h6>
                                    <h6 class="text-white"><i class="ion-android-arrow-dropup"></i> %20</h6>
                                </div>
                                <div id="lineToday">1,4,3,7,6,4,8,9,6,8,12</div>
                            </div>

                            <div class="box-body">
                                <ul class="flexbox flex-justified align-items-center">
                                    <li class="text-center">
                                        <div class="font-size-20 text-success">%60</div>
                                        <small class="text-uppercase">Direct sale</small>
                                    </li>

                                    <li class="text-center">
                                        <div class="font-size-20 text-info">%40</div>
                                        <small class="text-uppercase">Online sale</small>
                                    </li>

                                    <li class="text-center">
                                        <div class="font-size-20 text-warning">%40</div>
                                        <small class="text-uppercase">Whole sale</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <div class="row">

                        <div class="box">
                            <div class="box-header with-border">
                                <h5 class="box-title">Top Locations</h5>
                                <div class="box-tools pull-right">
                                    <ul class="card-controls">
                                        <li class="dropdown">
                                            <a data-toggle="dropdown" href="#"><i class="ion-android-more-vertical"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item active" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Yesterday</a>
                                                <a class="dropdown-item" href="#">Last week</a>
                                                <a class="dropdown-item" href="#">Last month</a>
                                            </div>
                                        </li>
                                        <li><a href="#" class="link card-btn-reload" data-toggle="tooltip" title="" data-original-title="Refresh"><i class="fa fa-circle-thin"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="text-center py-20">
                                    <div class="donut" data-peity='{ "fill": ["#7460ee", "#26c6da", "#fc4b6c"], "radius": 145, "innerRadius": 100  }' >9,6,5</div>
                                </div>

                                <ul class="flexbox flex-justified text-center mt-30">
                                    <li class="br-1">
                                        <div class="font-size-20 text-primary">953</div>
                                        <small>New York</small>
                                    </li>

                                    <li class="br-1">
                                        <div class="font-size-20 text-success">813</div>
                                        <small>Los Angeles</small>
                                    </li>

                                    <li>
                                        <div class="font-size-20 text-danger">369</div>
                                        <small>Dallas</small>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->

@stop
@section('javascript')

    <script>
        $( document ).ready(function() {

            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            // This will get the first returned node in the jQuery collection.
            var areaChart       = new Chart(areaChartCanvas)

            var areaChartData = {
                labels  : ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label               : 'Monthly Sales',
                        fillColor           : 'rgba(30,172,190,0.3)',
                        strokeColor         : 'rgba(30,172,190,0)',
                        pointColor          : 'rgba(30,172,190,0.5)',
                        pointStrokeColor    : '#1eacbe',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(30,172,190,1)',
                        data                : [5, 8, 6, 11, 5, 10, 14, 15, 14, 17, 29, 26, 30, 16, 37, 31, 44, 52]
                    }
                ]
            }

            var areaChartOptions = {
                //Boolean - If we should show the scale at all
                showScale               : true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                //String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                //Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                //Boolean - Whether the line is curved between points
                bezierCurve             : true,
                //Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.5,
                //Boolean - Whether to show a dot for each point
                pointDot                : true,
                //Number - Radius of each point dot in pixels
                pointDotRadius          : 1,
                //Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                //Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                //Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 0,
                //Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                //String - A legend template
		  //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
		  maintainAspectRatio     : true,
		  //Boolean - whether to make the chart responsive to window resizing
		  responsive              : true
		};

		//Create the line chart
		areaChart.Line(areaChartData, areaChartOptions);



        });
    </script>




@endsection



