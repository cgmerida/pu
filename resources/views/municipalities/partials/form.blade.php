<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">			
			{!! Form::mySelect('department_id', 'Departamento', $departments) !!}
			
			{!! Form::myInput('text', 'name', 'Nombre del Municipio') !!}
			
			{!! Form::myCheckbox('prime', 'prime', '¿Prime?', 'Si', null) !!}

			{!! Form::myCheckbox('legal', 'legal', '¿Es Legal?', 'Si', null) !!}
		</div>  
	</div>
</div>