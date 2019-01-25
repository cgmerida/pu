@extends('admin.master')

@section('css')
	@include('admin.partials.datatables')
@endsection

@section('page-header')
    Diputados Distrito <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        
        @can('deputies.create')
        <a href="{{ route('deputies.create') }}" class="btn btn-secondary">
            <i class="fa fa-plus-circle fa-fw"></i> Crear Nuevo Diputado
        </a>
        @endcan
        <br><br>
		<div class="row">
			<div class="col-4">
				{!! Form::mySelect('department_id', 'Departamento', $departments) !!}
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
                    <th>Departamento</th>
                    <th>Prime</th>
                    <th>Legal</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Departamento</th>
                    <th>Prime</th>
                    <th>Legal</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        
        </table>
    </div>

@endsection

@section('js')
    <script>
		let dtable;

		function searchDatatable() {

			const depto = parseInt($('#department_id').val()),
			url = `departments/${depto}/deputies`;

			if(dtable) {
				dtable.ajax.url(url).load();
			} else
				dtableInit(url);
		}

		function dtableInit(url) {
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
					{data: 'department.name'},
					{data: 'department.legal'},
					{data: 'department.prime'},
					{data: 'name'},
					{data: 'actions', orderable: false, searchable: false}
                ], 
                order: [[ 1, "desc" ]]
			});
		}
        
        function swallError(mensaje) {
            swal.fire("¡Error!", `<small class=text-danger>${mensaje}</small>`, "error");
        }

        function editName(url) {
            const body = {
                _method: "PUT",
                name: name
            };

            mySwall('Ingrese el nuevo Candidato', 'Actualizar', 'post', body, url);
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
    </script>
    
@endsection