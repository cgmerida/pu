@extends('admin.master')

@section('page-header')
	Rol <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($role, [
			'route' => ['roles.update', $role],
			'method' => 'put',
		])
	!!}

		@include('roles.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('roles.partials.js')
@endsection