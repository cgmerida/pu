
<ul class="list-inline">
    
    @can('departments.show')
    <li class="list-inline-item">
        <a href="{{ route('departments.show', $id) }}"
        title="Ver" class="btn btn-sm btn-outline-secondary">
            <span class="ti-eye"></span>
        </a>
    </li>
    @endcan
    
    @can('departments.edit')
    <li class="list-inline-item">
        <a href="{{ route('departments.edit', $id) }}" 
        title="{{ trans('app.edit_title') }}" data-toggle="tooltip"
        class="btn btn-outline-primary btn-sm">
            <span class="ti-pencil"></span>
        </a>
    </li>
    @endcan
    
    @can('departments.destroy')
    <li class="list-inline-item">
        {!! Form::open([
            'class'=>'delete',
            'route'  => ['departments.destroy', $id], 
            'method' => 'DELETE',
            ]) 
        !!}

            <button class="btn btn-outline-danger btn-sm" title="{{ trans('app.delete_title') }}">
                <i class="ti-trash"></i>
            </button>
            
        {!! Form::close() !!}
    </li>
    @endcan
</ul>