
<ul class="list-inline">
    @can('deputies.edit')
    <li class="list-inline-item">
        <button title="{{ trans('app.edit_title') }}" data-toggle="tooltip"
        class="btn btn-outline-primary btn-sm" onclick="editName('{{ route('deputies.update', $id) }}')">
            <span class="ti-pencil"></span>
        </button>
    </li>
    @endcan
    
    @can('deputies.destroy')
    <li class="list-inline-item">
        <button class="btn btn-outline-danger btn-sm" title="{{ trans('app.delete_title') }}"
        onclick="deleteDeputy('{{ route('deputies.destroy', $id) }}')">
            <i class="ti-trash"></i>
        </button>
    </li>
    @endcan
</ul>