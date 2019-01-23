<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			
			{!! Form::mySelect('department_id', 'Departamento', $departments) !!}
			
			{!! Form::mySelect('municipality_id', 'Municipio', $municipalities) !!}
			
			{!! Form::myInput('text', 'name', 'Nombre Completo del candidato') !!}
			
            {!! Form::mySelect('position', 'Posición', $positions) !!}
		</div>  
	</div>
</div>