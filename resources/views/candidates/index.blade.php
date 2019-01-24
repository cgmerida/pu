@extends('admin.master')

@section('css')
    @include('admin.partials.datatables')
@endsection

@section('page-header')
    Candidatos <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        @can('candidates.create')
        <a href="{{ route('candidates.create') }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
        @endcan
    </div>

    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>Departamento</th>
                    <th>Municipio</th>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Acciones</th>
                </tr>
            </tfoot>
        
        </table>
    </div>

@endsection

@section('js')
    <script>
        $('#dataTable').DataTable({
            ajax: '/api/candidates',
            columns: [
                {data: 'department.name'},
                {data: 'municipality.name'},
                {data: 'name'},
                {data: 'position'},
                {data: 'actions', orderable: false, searchable: false}
            ]
        });
    </script>
@endsection