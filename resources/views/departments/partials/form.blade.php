<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre del Departamento', ['disabled']) !!}
			
			{!! Form::myCheckbox('prime', 'prime', '¿Prime?', true) !!}
			<br>
			{!! Form::myCheckbox('legal', 'legal', '¿Legal?', true) !!}
		</div>  
	</div>
</div>