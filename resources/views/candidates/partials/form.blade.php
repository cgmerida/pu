<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'first_name', 'Nombres del candidato') !!}
			
			{!! Form::myInput('text', 'last_name', 'Apellidos del candidato') !!}
			
            {!! Form::mySelect('position', 'Posición', $positions) !!}
			
			{!! Form::mySelect('department_id', 'Departamento', $departments) !!}
			
            {!! Form::mySelect('municipality_id', 'Departamento', $municipalities) !!}
		</div>  
	</div>
</div>