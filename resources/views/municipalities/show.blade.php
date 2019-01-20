@extends('admin.master')

@section('page-header')
	Municipio <small>Visualizar</small>
@stop

@section('content')
	{!! Form::model($municipality, [
            'id' => 'main-form'
		])
	!!}

		@include('municipalities.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection