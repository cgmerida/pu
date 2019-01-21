@extends('admin.master')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highcharts/7.0.1/css/highcharts.css">

    <style>
        #mapa {
            height: 500px; 
            min-width: 310px; 
            max-width: 800px; 
            margin: 0 auto; 
        }
        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }
    </style>
@endsection

@section('content')

    <div class="row gap-20 masonry pos-r">
        <div class="masonry-item col-12">
            <!-- #Site Visits ==================== -->
            <div class="bd bgc-white">
                <div class="peers fxw-nw@lg+ ai-s">
                    <div class="peer peer-greed w-70p@lg+ w-100@lg- p-20">
                        <div class="layers">
                            <div class="layer w-100 mB-10">
                                <h6 class="lh-1">Site Visits</h6>
                            </div>
                            <div class="layer w-100">
                                <div id="mapa"></div>
                            </div>
                        </div>
                    </div>
                    <div class="peer bdL p-20 w-30p@lg+ w-100p@lg-">
                        <div class="layers">
                            <div class="layer w-100">
                                <!-- Progress Bars -->
                                <div class="layers">
                                    <div class="layer w-100">
                                        <h5 class="mB-5">100k</h5>
                                        <small class="fw-600 c-grey-700">Visitors From USA</small>
                                        <span class="pull-right c-grey-600 fsz-sm">50%</span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-deep-purple-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%;"> <span class="sr-only">50% Complete</span></div>
                                        </div>
                                    </div>
                                    <div class="layer w-100 mT-15">
                                        <h5 class="mB-5">1M</h5>
                                        <small class="fw-600 c-grey-700">Visitors From Europe</small>
                                        <span class="pull-right c-grey-600 fsz-sm">80%</span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-green-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">80% Complete</span></div>
                                        </div>
                                    </div>
                                    <div class="layer w-100 mT-15">
                                        <h5 class="mB-5">450k</h5>
                                        <small class="fw-600 c-grey-700">Visitors From Australia</small>
                                        <span class="pull-right c-grey-600 fsz-sm">40%</span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-light-blue-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:40%;"> <span class="sr-only">40% Complete</span></div>
                                        </div>
                                    </div>
                                    <div class="layer w-100 mT-15">
                                        <h5 class="mB-5">1B</h5>
                                        <small class="fw-600 c-grey-700">Visitors From India</small>
                                        <span class="pull-right c-grey-600 fsz-sm">90%</span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-blue-grey-500" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:90%;"> <span class="sr-only">90% Complete</span></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pie Charts -->
                                <div class="peers pT-20 mT-20 bdT fxw-nw@lg+ jc-sb ta-c gap-10">
                                    <div class="peer">
                                        <div class="easy-pie-chart" data-size='80' data-percent="75" data-bar-color='#f44336'>
                                            <span></span>
                                        </div>
                                        <h6 class="fsz-sm">New Users</h6>
                                    </div>
                                    <div class="peer">
                                        <div class="easy-pie-chart" data-size='80' data-percent="50" data-bar-color='#2196f3'>
                                            <span></span>
                                        </div>
                                        <h6 class="fsz-sm">New Purchases</h6>
                                    </div>
                                    <div class="peer">
                                        <div class="easy-pie-chart" data-size='80' data-percent="90" data-bar-color='#ff9800'>
                                            <span></span>
                                        </div>
                                        <h6 class="fsz-sm">Bounce Rate</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

	<script src=https://code.highcharts.com/highcharts.js></script>
    {{-- <script src=https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.5/js/themes/gray.js></script> --}}
	<script src=https://code.highcharts.com/maps/modules/map.js></script>
	<!-- <script src=https://code.highcharts.com/maps/modules/exporting.js></script> -->
	<!-- <script src=https://code.highcharts.com/mapdata/countries/gt/gt-all.js></script> -->
	<script src=https://code.highcharts.com/maps/modules/data.js></script>
	<script src=https://code.highcharts.com/maps/modules/drilldown.js></script>
    <!-- <script src=https://code.highcharts.com/highcharts-3d.js></script> -->
    
<script src="https://code.highcharts.com/mapdata/countries/gt/gt-all.js"></script>

    
    <script>
        $(function(){
            crearMapaDepto();
        });
        function crearMapaDepto(){
            // Prepare demo data
            // Data is joined to map using value of 'hc-key' property by default.
            // See API docs for 'joinBy' for more info on linking data and map.
            var data = [
                ['gt-qc', 0],
                ['gt-pe', 1],
                ['gt-hu', 2],
                ['gt-qz', 3],
                ['gt-re', 4],
                ['gt-sm', 5],
                ['gt-bv', 6],
                ['gt-av', 7],
                ['gt-es', 8],
                ['gt-cm', 9],
                ['gt-gu', 10],
                ['gt-su', 11],
                ['gt-sa', 12],
                ['gt-so', 13],
                ['gt-to', 14],
                ['gt-pr', 15],
                ['gt-sr', 16],
                ['gt-iz', 17],
                ['gt-cq', 18],
                ['gt-ja', 19],
                ['gt-ju', 20],
                ['gt-za', 21]
            ];

            // Create the chart
            Highcharts.mapChart('mapa', {
                chart: {
                    map: 'countries/gt/gt-all'
                },

                title: {
                    text: 'Highmaps basic demo'
                },

                subtitle: {
                    text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/gt/gt-all.js">Guatemala</a>'
                },

                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },

                colorAxis: {
                    min: 0
                },

                series: [{
                    data: data,
                    name: 'Random data',
                    states: {
                        hover: {
                            color: '#BADA55'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }]
            });

        };
    </script>
@endsection