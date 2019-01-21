<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre Completo del candidato') !!}
			
            {!! Form::mySelect('position', 'Posición', $positions) !!}
			
			{!! Form::mySelect('department_id', 'Departamento', $departments) !!}
			
            {!! Form::mySelect('municipality_id', 'Departamento', $municipalities) !!}
		</div>  
	</div>
</div>