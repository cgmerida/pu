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
                    <th>Legal</th>
                    <th>Prime</th>
                    <th>Nombre</th>
                    <th>Nominado</th>
                    <th>Inscrito</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Departamento</th>
                    <th>Legal</th>
                    <th>Prime</th>
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

    @include('deputies.partials.swals')
    
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
					{data: 'nominated'},
					{data: 'signed_up'},
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

        function nominateMayor(url) {
            const body = {
                _method: "PUT",
                attr: 'nominated'
            };
            myRadioSwall('Diputado Nominado', 'Guardar', 'post', body, url);
        }

        function signMayor(url) {
            const body = {
                _method: "PUT",
                attr: 'signed_up'
            };

            myRadioSwall('Diputado Inscrito', 'Guardar', 'post', body, url);
        }
    </script>
    
@endsection