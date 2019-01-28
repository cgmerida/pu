@extends('admin.master')

@section('css')
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
                        {!! Form::myRadio('tipo', 'legal', 'Mapa Organización', 'legals', true) !!}
                        
                        {!! Form::myRadio('tipo', 'prime', 'Mapa Prime', 'primes') !!}

                        {!! Form::myRadio('tipo', 'deputies', 'Mapa Diputados', 'deputies') !!}
                        
                        {!! Form::myRadio('tipo', 'mayors', 'Mapa Alcaldes', 'mayors') !!}
                        
                        {!! Form::myRadio('tipo', 'tours', 'Mapa Giras', 'tours') !!}
                        <div class="layers">
                            <div class="layer w-100">
                                <div id="mapa"></div>
                            </div>
                        </div>
                    </div>
                    <div class="peer bdL p-20 w-30p@lg+ w-100p@lg-">
                        <div class="layers">
                            <div class="layer w-100">
                                <!-- Progress Bars -->
                                <div class="layers mB-15" id="progress-layer">
                                    <div class="layer w-100 mT-15">
                                        <h5 class="mB-5">Alcaldes en Municipios Legales</h5>
                                        <small class="fsz-sm fw-400 c-grey-700" id="alcaldes-legal-titulo">
                                            {{ $e->alcaldesLegales }} de {{ $e->municipiosLegales }}
                                        </small>
                                        <span class="pull-right c-grey-600 fsz-sm" id="alcaldes-legal-per">
                                            {{ $e->alcaldesLegales_per }}%
                                        </span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-blue-700" role="progressbar"
                                            aria-valuenow="{{ $e->alcaldesLegales_per }}"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="width:{{ $e->alcaldesLegales_per }}%;"
                                            id="alcaldes-legal-bar"></div>
                                        </div>
                                    </div>
                                    <div class="layer w-100">
                                        <h5 class="mB-5">Alcaldes en Municipios No Legales</h5>
                                        <small class="fsz-sm fw-400 c-grey-700" id="alcaldes-no-legal-titulo">
                                            {{ $e->alcaldesNoLegales }} de {{ $e->municipiosNoLegales }}
                                        </small>
                                        <span class="pull-right c-grey-600 fsz-sm" id="alcaldes-no-legal-per">
                                            {{ $e->alcaldesNoLegales_per }}%
                                        </span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-brown-300" role="progressbar"
                                            aria-valuemin="0" aria-valuemax="100"
                                            aria-valuenow="{{ $e->alcaldesNoLegales_per }}"
                                            style="width:{{ $e->alcaldesNoLegales_per }}%;"
                                            id="alcaldes-no-legal-bar"></div>
                                        </div>
                                    </div>
                                    <div class="layer w-100">
                                        <h5 class="mB-5">Alcaldes General</h5>
                                        <small class="fsz-sm fw-400 c-grey-700" id="alcaldes-titulo">
                                            {{ $e->alcaldes }} de {{ $e->municipios }}
                                        </small>
                                        <span class="pull-right c-grey-600 fsz-sm" id="alcaldes-per">
                                            {{ $e->alcaldes_per }}%
                                        </span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-deep-purple-500" role="progressbar"
                                            aria-valuemin="0" aria-valuemax="100"
                                            aria-valuenow="{{ $e->alcaldes_per }}"
                                            style="width:{{ $e->alcaldes_per }}%;"
                                            id="alcaldes-bar"></div>
                                        </div>
                                    </div>
                                    <div class="layer w-100 mT-15">
                                        <h5 class="mB-5">Municipios Legales</h5>
                                        <small class="fsz-sm fw-400 c-grey-700" id="muni-titulo">
                                            {{ $e->municipiosLegales }} de {{ $e->municipios }}
                                        </small>
                                        <span class="pull-right c-grey-600 fsz-sm" id="muni-per">
                                            {{ $e->municipiosLegales_per }}%
                                        </span>
                                        <div class="progress mT-10">
                                            <div class="progress-bar bgc-green-500" role="progressbar"
                                            aria-valuenow="{{ $e->municipiosLegales_per }}"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="width:{{ $e->municipiosLegales_per }}%;"
                                            id="muni-bar"></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pie Charts -->
                                {{-- <div class="peers pT-20 mT-20 bdT fxw-nw@lg+ jc-sb ta-c gap-10">
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
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

	<script src={{ asset('js/highcharts/highcharts.js') }}></script>
    <script src={{ asset('js/highcharts/map.js') }}></script>
    <script src={{ asset('js/highcharts/exporting.js') }}></script>
    <script src={{ asset('js/highcharts/data.js') }}></script>
    <script src={{ asset('js/highcharts/drilldown.js') }}></script>
    
	<!-- <script src=https://code.highcharts.com/maps/modules/exporting.js></script> -->
	{{-- <script src=https://code.highcharts.com/maps/modules/data.js></script> --}}
	{{-- <script src=https://code.highcharts.com/maps/modules/drilldown.js></script> --}}
        
    {{-- <script src="{{ asset('js/highcharts/gt-all.geo.json') }}"></script> --}}

    <script src="{{ asset('js/highcharts/gt-all.js') }}"></script>

    <script src="{{ asset('js/highcharts/dashboard-map.js') }}"></script>

    

    <script>
        $(function(){
            Mapainit();

            $('input[type=radio]').change(function() {
                const tipo = $('input[type=radio]:checked').val();
                $("#mapa").highcharts().showLoading('<i class="fa fa-spinner fa-spin fa-3x"></i>');
                Mapainit(tipo);
            });
        });
    </script>
    
@endsection