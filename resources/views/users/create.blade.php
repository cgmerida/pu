@extends('admin.master')

@section('page-header')
	Usuario <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'users.store',
			'files' => true
		])
	!!}

		@include('users.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
