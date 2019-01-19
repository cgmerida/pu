@extends('admin.master')

@section('page-header')
	Rol <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'roles.store',
			'files' => true
		])
	!!}

		@include('roles.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('roles.partials.js')
@endsection