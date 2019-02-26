@extends('admin.master')

@section('page-header')
	Gira <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'tours.store',
			'files' => true
		])
	!!}

		@include('tours.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop


@section('js')
	<script>
		$(function(){
			$('#date').datetimepicker();
		});
	</script>
	
	@include('candidates.partials.selects')
@endsection