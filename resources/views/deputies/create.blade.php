@extends('admin.master')

@section('page-header')
	Diputado Distrito <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'deputies.store',
			'files' => true
		])
	!!}

		@include('deputies.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop