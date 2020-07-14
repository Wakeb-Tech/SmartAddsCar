@extends('client.layout-client')

@section('client_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{trans('client/index.Dashboard')}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right" style="float: right !important;">
                            <li class="breadcrumb-item"><a
                                    href="{{route('client.home')}}">{{trans('client/index.Home')}}</a></li>
                            <li class="breadcrumb-item active">{{trans('client/index.Dashboard')}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card card-default collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">Filter</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="screen_id"
                                           class="col-form-label text-md-right">{{ __('Screens') }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <select class="form-control" id="screen_id" name="screen_id"
                                            selected="{{ old('screen_id') }}">
                                        <option value="-1">All Screen</option>
                                    </select>&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="col-md-6">
                                    <label for="advertisement_id"
                                           class="col-form-label text-md-right">{{ __('Advertisements ') }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <select class="form-control" id="advertisement_id" name="advertisement_id"
                                            selected="{{ old('advertisement_id') }}">
                                        <option value="-1">All Advirtismnets</option>
                                    </select>&nbsp;&nbsp;&nbsp;
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="started"
                                           class="col-form-label text-md-right">{{ __('Start At') }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input id="started" placeholder="Enter Start Date" type="date" class="form-control"
                                           name="started" value="{{ old('started') }}"/> &nbsp;&nbsp;&nbsp;&nbsp;

                                </div>
                                <div class="col-md-6">
                                    <label for="ended" class="col-form-label text-md-right">{{ __('End At') }}</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input id="ended" placeholder="Enter End Date" type="date" class="form-control"
                                           name="ended" value="{{ old('ended') }}"/>&nbsp;

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" id="search">{{ __('search') }}</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Statistics</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Advertisement Name</th>
                                        <th>Attention</th>
                                        <th>Smiling</th>
                                        <th>No of Watching</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($advertisements) > 0)
                                        @foreach($advertisements as $advertisement)
                                            <tr>
                                                <td>{{$advertisement->name}}</td>
                                                <td>{{$advertisement->viewers()->sum('time_in_front_of_camera')}}</td>
                                                <td>{{$advertisement->viewers()->sum('smiling_percentage')}}</td>
                                                <td>{{$advertisement->viewers()->sum('number_of_people')}}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center"><h1>No Advertisements Found</h1></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Advertisement Name</th>
                                        <th>Attention</th>
                                        <th>Smiling</th>
                                        <th>No of Watching</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Statistics (Date With Smilling)</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="loading"></div>
                                <div id="chartdiv" class="chartdiv"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Statistics (Date With Smilling,number of people and time in front
                                    camira)</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body chart_view">
                                <div class="loading"></div>
                                <div id="chartdiv2" class="chartdiv"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Statistics (Model)</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body chart_view">
                                <div class="loading"></div>
                                <div id="chartdiv3" class="chartdiv"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Statistics (Gender)</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body chart_view">
                                <div class="loading"></div>
                                <div id="chartdiv4" class="chartdiv"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Statistics (Age)</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body chart_view">
                                <div class="loading"></div>
                                <div id="chartdiv5" class="chartdiv"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Statistics (Total)</h3> &nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body chart_view">
                                <div class="loading"></div>
                                <div id="chartdiv6" class="chartdiv"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <hr/>
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('admin_charts')
    <script>
        var filtered_datab;
        $.ajax({
            type: 'GET',
            url: "{{route('client.get_screen')}}",
            data: {'user_id': "{{Auth::user()->id}}"},
            success: function (data) {
                $('#screen_id').empty();
                if (data[0]) {
                    var html = `<option value="-1">All Screen</option>`
                } else {
                    var html = `<option value="0">No Screen For this user</option>`
                }

                data.forEach(function (item) {
                    html += `<option value="` + item.id + `">` + item.name + `</option>`
                });
                $('#screen_id').append(html)
            }
        });

        $('#screen_id').on('change', function () {
            $.ajax({
                type: 'GET',
                url: "{{route('admin.get_screen')}}",
                data: {'screen_id': $('#screen_id').val()},
                success: function (data) {
                    $('#advertisement_id').empty();
                    if (data[0]) {
                        var html = `<option value="-1">All Advirtisaments</option>`
                    } else {
                        var html = `<option value="0">No Advirtisaments For this user</option>`
                    }

                    data.forEach(function (item) {
                        html += `<option value="` + item.id + `">` + item.name + `</option>`
                    });
                    $('#advertisement_id').append(html)
                }
            });
        })

        $('#search').on('click', function () {
            ajax();
        })
        ajax();

        function ajax() {
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $('.loading').append(`<div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>`)
            $.ajax({
                type: 'POST',
                url: "{{route('client.statistic.search')}}",
                data: {
                    'screen_id': $('#screen_id').val(),
                    'user_id': "{{Auth::user()->id}}",
                    'advertisement_id': $('#advertisement_id').val(),
                    'started': $('#started').val(),
                    'ended': $('#ended').val(),
                },
                success: function (data) {
                    $('.loading').empty()
                    filtered_datab = data
                    smilling(filtered_datab['smilling']);
                    total_analysis(filtered_datab['total']);
                    model(filtered_datab['models']);
                    gender(filtered_datab['gender']);
                    age(filtered_datab['age']);
                    analysis(filtered_datab['attention']);
                }
            });
        }
    </script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script>

        function total_analysis(data) {
            var chart = AmCharts.makeChart("chartdiv2", {
                "type": "serial",
                "theme": "none",
                "legend": {
                    "useGraphSettings": true
                },
                "dataProvider": data,
                "synchronizeGrid": true,
                "valueAxes": [{
                    "id": "v1",
                    "axisColor": "#FF6600",
                    "axisThickness": 2,
                    "axisAlpha": 1,
                    "position": "left"
                }, {
                    "id": "v2",
                    "axisColor": "#FCD202",
                    "axisThickness": 2,
                    "axisAlpha": 1,
                    "position": "right"
                }, {
                    "id": "v3",
                    "axisColor": "#B0DE09",
                    "axisThickness": 2,
                    "gridAlpha": 0,
                    "offset": 50,
                    "axisAlpha": 1,
                    "position": "left"
                }],
                "graphs": [{
                    "valueAxis": "v1",
                    "lineColor": "#FF6600",
                    "bullet": "round",
                    "bulletBorderThickness": 1,
                    "hideBulletsCount": 30,
                    "title": "Number of People",
                    "valueField": "visits",
                    "fillAlphas": 0
                }, {
                    "valueAxis": "v2",
                    "lineColor": "#FCD202",
                    "bullet": "square",
                    "bulletBorderThickness": 1,
                    "hideBulletsCount": 30,
                    "title": "Smilling line",
                    "valueField": "hits",
                    "fillAlphas": 0
                }, {
                    "valueAxis": "v3",
                    "lineColor": "#B0DE09",
                    "bullet": "triangleUp",
                    "bulletBorderThickness": 1,
                    "hideBulletsCount": 30,
                    "title": "Time Line",
                    "valueField": "views",
                    "fillAlphas": 0
                }],
                "chartScrollbar": {},
                "chartCursor": {
                    "cursorPosition": "mouse"
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "axisColor": "#DADADA",
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true,
                    "position": "bottom-right"
                }
            });

            chart.addListener("dataUpdated", zoomChart);
            zoomChart();

            function zoomChart() {
                chart.zoomToIndexes(chart.dataProvider.length - 20, chart.dataProvider.length - 1);
            }
        }

        function model(data) {
            var chart = AmCharts.makeChart("chartdiv3", {
                "type": "pie",
                "theme": "none",
                "innerRadius": "40%",
                "gradientRatio": [-0.4, -0.4, -0.4, -0.4, -0.4, -0.4, 0, 0.1, 0.2, 0.1, 0, -0.2, -0.5],
                "dataProvider": data,
                "balloonText": "[[value]]",
                "valueField": "litres",
                "titleField": "country",
                "balloon": {
                    "drop": true,
                    "adjustBorderColor": false,
                    "color": "#FFFFFF",
                    "fontSize": 16
                },
                "export": {
                    "enabled": true
                }
            });
        }

        function smilling(data) {
            var chart = AmCharts.makeChart("chartdiv", {
                "type": "serial",
                "theme": "none",
                "marginRight": 40,
                "marginLeft": 40,
                "autoMarginOffset": 20,
                "mouseWheelZoomEnabled": true,
                "dataDateFormat": "YYYY-MM-DD",
                "valueAxes": [{
                    "id": "v1",
                    "axisAlpha": 0,
                    "position": "left",
                    "ignoreAxisWidth": true
                }],
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "graphs": [{
                    "id": "g1",
                    "balloon": {
                        "drop": true,
                        "adjustBorderColor": false,
                        "color": "#ffffff"
                    },
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "title": "red line",
                    "useLineColorForBulletBorder": true,
                    "valueField": "value",
                    "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis": false,
                    "offset": 30,
                    "scrollbarHeight": 80,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha": 1,
                    "cursorColor": "#258cbb",
                    "limitToGraph": "g1",
                    "valueLineAlpha": 0.2,
                    "valueZoomable": true
                },
                "valueScrollbar": {
                    "oppositeAxis": false,
                    "offset": 50,
                    "scrollbarHeight": 10
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "export": {
                    "enabled": true
                },
                "dataProvider": data
            });

            chart.addListener("rendered", zoomChart);

            zoomChart();

            function zoomChart() {
                chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
            }
        }

        function gender(data) {
            var chart = AmCharts.makeChart("chartdiv4",
                {
                    "type": "serial",
                    "theme": "none",
                    "dataProvider": data,
                    "valueAxes": [{
                        "maximum": 1000,
                        "minimum": 0,
                        "axisAlpha": 0,
                        "dashLength": 4,
                        "position": "left"
                    }],
                    "startDuration": 1,
                    "graphs": [{
                        "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
                        "bulletOffset": 10,
                        "bulletSize": 52,
                        "colorField": "color",
                        "cornerRadiusTop": 8,
                        "customBulletField": "bullet",
                        "fillAlphas": 0.8,
                        "lineAlpha": 0,
                        "type": "column",
                        "valueField": "points"
                    }],
                    "marginTop": 0,
                    "marginRight": 0,
                    "marginLeft": 0,
                    "marginBottom": 0,
                    "autoMargins": false,
                    "categoryField": "name",
                    "categoryAxis": {
                        "axisAlpha": 0,
                        "gridAlpha": 0,
                        "inside": true,
                        "tickLength": 0
                    },
                    "export": {
                        "enabled": true
                    }
                });
        }

        function age(data) {
            var chart = AmCharts.makeChart("chartdiv5", {
                "type": "serial",
                "theme": "none",
                "marginRight": 70,
                "dataProvider": data,
                "valueAxes": [{
                    "axisAlpha": 0,
                    "position": "left",
                    "title": "Visitors from country"
                }],
                "startDuration": 1,
                "graphs": [{
                    "balloonText": "<b>[[category]]: [[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 0.9,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "visits"
                }],
                "chartCursor": {
                    "categoryBalloonEnabled": false,
                    "cursorAlpha": 0,
                    "zoomable": false
                },
                "categoryField": "country",
                "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 45
                },
                "export": {
                    "enabled": true
                }

            });
        }

        function analysis(data) {
            var chart = AmCharts.makeChart("chartdiv6", {
                "type": "serial",
                "theme": "none",
                "dataDateFormat": "YYYY-MM-DD",
                "precision": 0,
                "valueAxes": [{
                    "id": "v1",
                    "title": "Values",
                    "position": "left",
                    "autoGridCount": false,
                    "labelFunction": function (value) {
                        return value;
                    }
                }, {
                    "id": "v2",
                    "title": "Market Days",
                    "gridAlpha": 0,
                    "position": "right",
                    "autoGridCount": false
                }],
                "graphs": [{
                    "id": "g3",
                    "valueAxis": "v1",
                    "lineColor": "#e1ede9",
                    "fillColors": "#e1ede9",
                    "fillAlphas": 1,
                    "type": "column",
                    "title": "num watchers",
                    "valueField": "sales2",
                    "clustered": false,
                    "columnWidth": 0.5,
                    "legendValueText": "[[value]]",
                    "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
                }, {
                    "id": "g4",
                    "valueAxis": "v1",
                    "lineColor": "#62cf73",
                    "fillColors": "#62cf73",
                    "fillAlphas": 1,
                    "type": "column",
                    "title": "Total Smillimg",
                    "valueField": "sales1",
                    "clustered": false,
                    "columnWidth": 0.3,
                    "legendValueText": "[[value]]",
                    "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
                }, {
                    "id": "g1",
                    "valueAxis": "v2",
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "lineColor": "#20acd4",
                    "type": "smoothedLine",
                    "title": "num people",
                    "useLineColorForBulletBorder": true,
                    "valueField": "market1",
                    "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
                }, {
                    "id": "g2",
                    "valueAxis": "v2",
                    "bullet": "round",
                    "bulletBorderAlpha": 1,
                    "bulletColor": "#FFFFFF",
                    "bulletSize": 5,
                    "hideBulletsCount": 50,
                    "lineThickness": 2,
                    "lineColor": "#e1ede9",
                    "type": "smoothedLine",
                    "dashLength": 5,
                    "title": "attentions",
                    "useLineColorForBulletBorder": true,
                    "valueField": "market2",
                    "balloonText": "[[title]]<br /><b style='font-size: 130%'>[[value]]</b>"
                }],
                "chartScrollbar": {
                    "graph": "g1",
                    "oppositeAxis": false,
                    "offset": 30,
                    "scrollbarHeight": 50,
                    "backgroundAlpha": 0,
                    "selectedBackgroundAlpha": 0.1,
                    "selectedBackgroundColor": "#888888",
                    "graphFillAlpha": 0,
                    "graphLineAlpha": 0.5,
                    "selectedGraphFillAlpha": 0,
                    "selectedGraphLineAlpha": 1,
                    "autoGridCount": true,
                    "color": "#AAAAAA"
                },
                "chartCursor": {
                    "pan": true,
                    "valueLineEnabled": true,
                    "valueLineBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "valueLineAlpha": 0.2
                },
                "categoryField": "date",
                "categoryAxis": {
                    "parseDates": true,
                    "dashLength": 1,
                    "minorGridEnabled": true
                },
                "legend": {
                    "useGraphSettings": true,
                    "position": "top"
                },
                "balloon": {
                    "borderThickness": 1,
                    "shadowAlpha": 0
                },
                "export": {
                    "enabled": true
                },
                "dataProvider": data
            });
        }
    </script>
@endpush
