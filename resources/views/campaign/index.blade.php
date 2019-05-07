@extends('admin.master')

@section('css')
	@include('admin.partials.datatables')
@endsection

@section('page-header')
    Campaña Municipio <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        
        @can('campaign.create')
        <a href="{{ route('campaign.create') }}" class="btn btn-secondary">
            <i class="fa fa-plus-circle fa-fw"></i> Crear Gira Campaña
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
                    <th>Municipio</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Fecha</th>
                    <th>Estatus</th>
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
			url = `departments/${depto}/campaign`;

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
					{data: 'municipality.name'},
					{data: 'date'},
					{data: 'status'},
					{data: 'actions', orderable: false, searchable: false}
                ], 
                order: [[ 1, "desc" ]]
			});
        }
        
        function closeTour(url) {
            swal.fire({
                title: "Seleccione un estatus",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn btn-outline-danger",
                cancelButtonClass: "btn btn-outline-primary",
                confirmButtonText: "Si, estoy seguro",
                cancelButtonText: "Cancelar",
                input: 'select',
                inputOptions: {
                    'Pendiente': 'Pendiente',
                    'Realizada': 'Realizada'
                },
                inputPlaceholder: 'Seleccione el estatus',
                showLoaderOnConfirm: true,
                preConfirm: (value) => {
                    return axios.put(url, {
                        status: value
                    })
                    .then(response => {
                        if (response.data.status != 'exito'){
                            throw new Error(response.statusText)
                        }
                        return response.data;
                    })
                    .catch(error => {
                        swal.showValidationMessage(
                        `Fallo la petición: ${error}`
                        )
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
            })
            .then(response => {
                console.log(response);
                const status = response.value.status;
                const message = response.value.message;
                
                searchDatatable();
                swal.fire(status, message, 'success');
            });
        }

        
        function deleteTour(url) {
            swal.fire({
                title: "¿Estás Seguro?",
                text: "¿Estás seguro de querer continuar?",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: "btn btn-outline-danger",
                cancelButtonClass: "btn btn-outline-primary",
                confirmButtonText: "Si, estoy seguro",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: (value) => {
                    return axios.delete(url)
                    .then(response => {
                        if (response.data.status != 'exito'){
                            throw new Error(response.statusText)
                        }
                        return response.data;
                    })
                    .catch(error => {
                        swal.showValidationMessage(
                        `Fallo la petición: ${error}`
                        )
                    })
                },
                allowOutsideClick: () => !swal.isLoading()
            })
            
            .then(response => {
                console.log(response);
                const status = response.value.status;
                const message = response.value.message;
                
                searchDatatable();
                swal.fire(status, message, 'success');
            });
        }
        
        function swallError(mensaje) {
            swal.fire("¡Error!", `<small class=text-danger>${mensaje}</small>`, "error");
        }
    </script>
@endsection