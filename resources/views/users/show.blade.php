@extends('admin.master')

@section('page-header')
	Usuario <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($user, [
            'id' => 'main-form'
		])
	!!}

		@include('users.partials.form')
		
        @include('admin.partials.back')
        
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('admin.partials.disable')
@endsection