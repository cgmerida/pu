<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre del Departamento', ['disabled']) !!}
			
			{!! Form::myCheckbox('prime', 'prime', '¿Prime?', true, null) !!}

			{!! Form::myCheckbox('legal', 'legal', '¿Es Legal?', true, null) !!}
		</div>  
	</div>
</div>