
<ul class="list-inline">
    @can('department_campaign.edit')
    <li class="list-inline-item">
        <a title="{{ trans('app.edit_title') }}" data-toggle="tooltip"
        class="btn btn-outline-primary btn-sm" href="{{ route('department_campaign.edit', $id) }}">
            <span class="ti-pencil"></span>
        </a>
    </li>
    @endcan
    
    @can('department_campaign.destroy')
    <li class="list-inline-item">
        <button class="btn btn-outline-danger btn-sm" title="{{ trans('app.delete_title') }}"
        onclick="deleteTour('{{ route('department_campaign.destroy', $id) }}')">
            <i class="ti-trash"></i>
        </button>
    </li>
    @endcan
</ul>