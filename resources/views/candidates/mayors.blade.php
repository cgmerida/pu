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
    </script>
@endsection