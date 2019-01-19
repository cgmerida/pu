@extends('admin.master')

@section('page-header')
	Departamento <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($department, [
			'route' => ['departments.update', $department],
			'method' => 'put',
		])
	!!}

		@include('departments.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
