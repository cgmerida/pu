@extends('admin.master')

@section('css')
	@include('admin.partials.datatables')
@endsection

@section('page-header')
    Candidatos <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
		<div class="row">
			<div class="col-4">
				{!! Form::mySelect('department_id', 'Departamento', $departments) !!}
			</div>
			<div class="col-4">
				{!! Form::mySelect('municipality_id', 'Municipio', $municipalities) !!}
			</div>
		</div>

        <button class="btn btn-info" onclick="searchDatatable()">
            <i class="fa fa-search"></i> Buscar
        </button >
    </div>

    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Municipio</th>
                    <th>Municipio Legal</th>
                    <th>Nombre</th>
                    <th>Nominado</th>
                    <th>Inscrito</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Municipio</th>
                    <th>Municipio Legal</th>
                    <th>Nombre</th>
                    <th>Nominado</th>
                    <th>Inscrito</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        
        </table>
    </div>

@endsection

@section('js')

	@include('candidates.partials.selects')

    <script>
		let dtable;

		function searchDatatable() {

			const depto = parseInt($('#department_id').val()),
			muni = parseInt($('#municipality_id').val())|| 0,
			url = `mayors/${depto}/${muni}`;

			if(dtable) {
				dtable.ajax.url(url).load();
			} else
				dtableInit(depto, muni, url);
		}

		function dtableInit(depto, muni, url) {
			dtable = $('#dataTable').DataTable({
				ajax: {
					url: url,
					type: 'get',
					error: function (err) {
						alert('Error al buscar');
						console.log(err);
					}
				},
				columns: [
					{data: 'name'},
					{data: 'legal'},
					{data: 'mayor.name'},
					{data: 'mayor.nominated'},
					{data: 'mayor.signed_up'},
					{data: 'actions', orderable: false, searchable: false}
                ], 
                order: [[ 1, "desc" ]]
			});
		}
        
        function swallError(mensaje) {
            swal("¡Error!", `<small class=text-danger>${mensaje}</small>`, "error");
        }

        function createMayor(depto, muni) {
            const body = {
                department_id: depto,
                municipality_id: muni
            };

            mySwall('Crear Nuevo Candidato', 'Crear', 'post', body, 'mayors/');
        }

        function editName(url) {
            const body = {
                _method: "PUT",
                name: name
            };

            mySwall('Ingrese el nuevo Candidato', 'Actualizar', 'post', body, url);
        }
        
        function nominateMayor(url) {
            const body = {
                _method: "PUT",
                attr: 'nominated'
            };
            myRadioSwall('Alcalde Nominado', 'Guardar', 'post', body, url);
        }

        function signMayor(url) {
            const body = {
                _method: "PUT",
                attr: 'signed_up'
            };

            myRadioSwall('Alcalde Inscrito', 'Guardar', 'post', body, url);
        }

        function deleteMayor(url) {
            swal.fire({
                title: "¿Estás Seguro?",
                text: "¿Estás seguro de querer continuar?",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn btn-outline-danger",
                cancelButtonClass: "btn btn-outline-primary",
                confirmButtonText: "Si, estoy seguro",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true
            }).then(res => {
                if (res.value) {
                    return fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'post',
                        credentials: "same-origin",
                        body: JSON.stringify({
                            _method: "DELETE",
                        })}
                    )
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(response.statusText)
                    console.log(response);
                }
                return response.json();
            })
            .then(result => {
                if (result.status == 'exito'){
                    searchDatatable();
                    swal.fire(result.status, result.message,'success')
                }
            })
            .catch(error => {
                swal.showValidationMessage(`fallo la petición: ${error}`)
            })
        }

        function mySwall(title, btn_txt, method, body, url){
            swal.fire({
                title: title,
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: btn_txt,
                showLoaderOnConfirm: true,
                preConfirm: (name) => {
                    body.name = name;
                    return fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: method,
                        credentials: "same-origin",
                        body: JSON.stringify(body)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                            console.log(response);
                        }
                        return response.json()
                    })
                    .catch(error => {
                        swal.showValidationMessage(`fallo la petición: ${error}`)
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
            })
            .then((result) => {
                if (result.value) {
                    if (result.value.status == 'exito'){
                        searchDatatable();
                        swal.fire(result.value.status, result.value.message,'success')
                    }
                }
            })
        }
        
        function myRadioSwall(title, btn_txt, method, body, url){
            swal.fire({
                title: title,
                input: 'radio',
                inputOptions: {
                    'true': 'Si',
                    'false': 'No'
                },
                showCancelButton: true,
                confirmButtonText: btn_txt,
                showLoaderOnConfirm: true,
                inputValidator: (value) => {
                    return !value && 'Tienes que elegir una opcion!'
                },
                preConfirm: (option) => {
                    body.option = option;
                    return fetch(url, {
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: method,
                        credentials: "same-origin",
                        body: JSON.stringify(body)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                            console.log(response);
                        }
                        return response.json()
                    })
                    .catch(error => {
                        swal.showValidationMessage(`fallo la petición: ${error}`)
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
            })
            .then((result) => {
                if (result.value) {
                    if (result.value.status == 'exito'){
                        searchDatatable();
                        swal.fire(result.value.status, result.value.message,'success')
                    }
                }
            })
        }
    </script>
    
@endsection