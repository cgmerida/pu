<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Nombre del Rol') !!}

			{!! Form::myInput('text', 'slug', 'Alias') !!}

			{!! Form::myTextArea('description', 'Descripción') !!}
			
			<hr>
			<h3>Permiso especial</h3>
			<div class="form-group">
				<div class="custom-control custom-radio">
					{{ Form::radio('special', 'all-access', null, 
						['class' => 'custom-control-input', 'id' => 'all']) }}
					<label class="custom-control-label" for="all">Acceso Total</label>
				</div>

				<div class="custom-control custom-radio">
					{{ Form::radio('special', 'no-access', null, 
						['class' => 'custom-control-input', 'id' => 'no']) }}
					<label class="custom-control-label" for="no">Ningún acceso</label>
				</div>
			</div>
			<hr>
			
			<h3>Lista de Permisos</h3>
			<div class="form-group">
				<ul class="list-unstyled">
					@foreach ($permissions as $permission)
						<li>
							{!! Form::myCheckbox('permissions[]', 'permission'.$permission->id, $permission->name, $permission->id, null) !!}
							<em>({{ $permission->description ?? 'Sin descripción' }})</em>
						</li>
					@endforeach
				</ul>
			</div>
		</div>  
	</div>
</div>