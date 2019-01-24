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
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Municipio Legal</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Municipio Legal</th>
                    <th>Nombre</th>
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
					{data: 'department.name'},
					{data: 'name'},
					{data: 'legal'},
					{data: 'candidates.name'},
					{data: 'actions'}
				]
			});
		}
        
        function swallError(mensaje) {
            swal("¡Error!", `<small class=text-danger>${mensaje}</small>`, "error");
        }
        function editName(id) {
            console.log(`mayors/${id}`);
            swal.fire({
                title: 'Ingrese el Nuevo Candidato',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Actualizar',
                showLoaderOnConfirm: true,
                preConfirm: (name) => {
                    return fetch(`mayors/${id}`,{
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "post",
                        credentials: "same-origin",
                        body: JSON.stringify({
                            _method: "PUT",
                            name: name
                        })}
                    )
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
                    if (resutl.value.status == 'exito'){
                        searchDatatable();
                        swal.fire(result.value.message, `Nombre fue cambiado a ${result.value.mayor.name}`, 'success')
                        console.log(`Fue actualizado el candidato no. ${result.value.mayor.name.id}`)
                    }
                }
            })
        }
        function createMayor(depto, muni) {
            swal.fire({
                title: 'Crear Nuevo Candidato',
                input: 'text',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Crear',
                showLoaderOnConfirm: true,
                preConfirm: (name) => {
                    return fetch(`mayors/`,{
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "post",
                        credentials: "same-origin",
                        body: JSON.stringify({
                            name: name,
                            department_id: depto,
                            municipality_id: muni,
                            position: 'Alcalde'
                        })}
                    )
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
                        swal.fire(
                            result.value.message,
                            `Fue creado ${result.value.mayor.name} 
                            en ${result.value.mayor.depto}, ${result.value.mayor.muni}`,
                            'success'
                            )
                    }
                }
            })
        }
    </script>
@endsection