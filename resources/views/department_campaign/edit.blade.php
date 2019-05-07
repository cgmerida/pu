@extends('admin.master')

@section('page-header')
	Gira Departamental <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($tour, [
			'route' => ['department_campaign.update', $tour],
			'method' => 'put',
		])
	!!}

		@include('department_campaign.partials.form')

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