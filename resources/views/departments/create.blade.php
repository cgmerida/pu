@extends('admin.master')

@section('page-header')
	Departamento <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'departments.store',
			'files' => true
		])
	!!}

		@include('departments.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
