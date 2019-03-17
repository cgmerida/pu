<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::mySelect('department_id', 'Departamento', $departments) !!}
			
			{!! Form::mySelect('municipality_id', 'Municipios', $municipalities) !!}

			{!! Form::myInput('number','number', 'Número de Campaña', ['min' => 1, 'max' => 2]) !!}
			
			{!! Form::datePicker('date', 'Fecha', ['autocomplete' => 'off']) !!}
		</div>  
	</div>
</div>