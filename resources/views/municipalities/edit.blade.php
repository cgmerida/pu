@extends('admin.master')

@section('page-header')
	Municipio <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($municipality, [
			'route' => ['municipalities.update', $municipality],
			'method' => 'put',
		])
	!!}

		@include('municipalities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
