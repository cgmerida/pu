@extends('admin.master')

@section('css')
    <style>
        #mapa {
            height: 85vh;
            min-height: 400px;
            width: 100%;
            min-width: 200px;
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
                        
                        {!! Form::myRadio('tipo', 'prime', 'Mapa Prime', 'primes', ($tipo == 'primes' ) ? true:false) !!}

                        {!! Form::myRadio('tipo', 'legal', 'Mapa Organización', 'legals', ($tipo == 'legals') ? true:false) !!}

                        {!! Form::myRadio('tipo', 'deputies', 'Mapa Diputados', 'deputies', ($tipo == 'deputies') ? true:false) !!}
                        
                        {!! Form::myRadio('tipo', 'mayors', 'Mapa Alcaldes', 'mayors', ($tipo == 'mayors') ? true:false) !!}
                        
                        {!! Form::myRadio('tipo', 'tours', 'Mapa Giras', 'tours', ($tipo == 'tours') ? true:false) !!}

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
                                    <div class="layer w-100 mT-20 c-grey-900">
                                        <center>
                                            <i class="fa fa-circle-o-notch fa-spin fa-5x"></i>
                                        </center>
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
            
            $(window).resize(function() {
                clearTimeout(this.id);
                this.id = setTimeout(doneResizing, 300);
            });

            function doneResizing(){
                const mapa = $("#mapa").highcharts();
                let width = 0;
                if ($(document).width() < 1200){
                    width = $("#mapa").closest('.peers').width() - 25;
                } else {
                    width = $("#mapa").width() - 25;
                }
                if(mapa){
                    mapa.setSize(width, null, false);
                }
            }
        });
    </script>
    
@endsection