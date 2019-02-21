
<ul class="list-inline">
    @can('deputies.edit')
    <li class="list-inline-item">
        <button title="{{ trans('app.edit_title') }}" data-toggle="tooltip"
        class="btn btn-outline-primary btn-sm" onclick="editName('{{ route('deputies.update', $id) }}')">
            <span class="ti-pencil"></span>
        </button>
    </li>
    
    <li class="list-inline-item">
        <button class="btn btn-outline-dark btn-sm" title="Nominar"
        onclick="nominateMayor('{{ route('deputies.update', $id) }}')">
            <i class="ti-thumb-up"></i>
        </button>
    </li>
    
    <li class="list-inline-item">
        <button class="btn btn-outline-success btn-sm" title="Inscribir"
        onclick="signMayor('{{ route('deputies.update', $id) }}')">
            <i class="ti-flag-alt"></i>
        </button>
    </li>

    @endcan
    
    @can('deputies.destroy')
    <li class="list-inline-item">
        <button class="btn btn-outline-danger btn-sm" title="{{ trans('app.delete_title') }}"
        onclick="deleteCandidate('{{ route('deputies.destroy', $id) }}')">
            <i class="ti-trash"></i>
        </button>
    </li>
    @endcan
</ul>