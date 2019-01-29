@extends('admin.master')

@section('page-header')
	Departamento <small>Editar</small>
@stop

@section('content')
	{!! Form::model($department, [
            'id' => 'main-form'
		])
	!!}

		@include('departments.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection