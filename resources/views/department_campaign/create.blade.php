@extends('admin.master')

@section('page-header')
	Campaña Departamental<small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => 'department_campaign.store',
			'files' => true
		])
	!!}

		@include('department_campaign.partials.form')

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