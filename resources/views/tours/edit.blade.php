@extends('admin.master')

@section('page-header')
	Gira <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($tour, [
			'route' => ['tours.update', $tour],
			'method' => 'put',
		])
	!!}

		@include('tours.partials.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop

@section('js')
	<script>
		$(function(){
			$('#date').datetimepicker();
		});
	</script>
@endsection