@extends('admin.master')

@section('page-header')
	Candidato <small>Visualizar</small>
@stop

@section('content')
	{!! Form::model($candidate, [
            'id' => 'main-form'
		])
	!!}

		@include('candidates.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection