<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre') !!}

			{!! Form::myInput('text', 'lastname', 'Apellido') !!}

			{!! Form::myInput('text', 'username', 'Usuario') !!}
	
			{!! Form::myInput('email', 'email', 'Correo') !!}
	
			{!! Form::myInput('password', 'password', 'Contraseña') !!}
	
			{!! Form::myInput('password', 'password_confirmation', 'Su contraseña de nuevo') !!}

			<hr>
			
			<h3>Lista de Roles</h3>
			<div class="form-group">
				<ul class="list-unstyled">
					@foreach ($roles as $role)
						<li>
							{!! Form::myCheckbox('roles[]', 'role'.$role->id, $role->name, $role->id, null) !!}
							<em>({{ $role->description ?? 'Sin descripción' }})</em>
						</li>
					@endforeach
				</ul>
			</div>
			
		</div>  
	</div>
</div>