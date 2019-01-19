@extends('admin.master')

@section('page-header')
	Departamento <small>Editar</small>
@stop

@section('content')
	{!! Form::model($deparment, [
            'id' => 'main-form'
		])
	!!}

		@include('deparments.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection