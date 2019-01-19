@extends('admin.master')

@section('page-header')
	Rol <small>ver</small>
@stop

@section('content')
	{!! Form::model($role, [
            'id' => 'main-form'
		])
	!!}

		@include('roles.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection