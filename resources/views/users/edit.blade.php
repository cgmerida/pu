@extends('admin.master')

@section('page-header')
	Usuario <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($user, [
			'route' => ['users.update', $user],
			'method' => 'put',
		])
	!!}

		@include('users.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
