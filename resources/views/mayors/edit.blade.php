@extends('admin.master')

@section('page-header')
	Candidato <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($candidate, [
			'route' => ['candidates.update', $candidate],
			'method' => 'put',
		])
	!!}

		@include('candidates.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop

@section('js')
	@include('candidates.partials.selects')
@endsection