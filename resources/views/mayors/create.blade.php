@extends('admin.master')

@section('page-header')
	Candidato <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'candidates.store',
			'files' => true
		])
	!!}

		@include('candidates.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('candidates.partials.selects')
@endsection