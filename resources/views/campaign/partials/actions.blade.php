
<ul class="list-inline">
    @can('campaign.edit')
    <li class="list-inline-item">
        <a title="{{ trans('app.edit_title') }}" data-toggle="tooltip"
        class="btn btn-outline-primary btn-sm" href="{{ route('campaign.edit', $id) }}">
            <span class="ti-pencil"></span>
        </a>
    </li>
    
    <li class="list-inline-item">
        <button class="btn btn-outline-success btn-sm" title="Cerrar"
        onclick="closeTour('{{ route('campaign.close', $id) }}')">
            <i class="ti-close"></i>
        </button>
    </li>

    @endcan
    
    @can('campaign.destroy')
    <li class="list-inline-item">
        <button class="btn btn-outline-danger btn-sm" title="{{ trans('app.delete_title') }}"
        onclick="deleteTour('{{ route('campaign.destroy', $id) }}')">
            <i class="ti-trash"></i>
        </button>
    </li>
    @endcan
</ul>