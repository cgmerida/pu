@extends('admin.master')

@section('page-header')
	Municipio <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'municipalities.store',
			'files' => true
		])
	!!}

		@include('municipalities.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
