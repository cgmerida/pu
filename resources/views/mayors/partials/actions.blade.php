
<ul class="list-inline">
    @if ($candidate_id > 0)
        @can('mayors.edit')
        <li class="list-inline-item">
            <button title="{{ trans('app.edit_title') }}" data-toggle="tooltip"
            class="btn btn-outline-primary btn-sm" onclick="editName({{ $candidate_id }})">
                <span class="ti-pencil"></span>
            </button>
        </li>
        @endcan
        
        @can('mayors.destroy')
        <li class="list-inline-item">
            {!! Form::open([
                'class'=>'delete',
                'route'  => ['mayors.destroy', $candidate_id], 
                'method' => 'DELETE',
                ]) 
            !!}

                <button class="btn btn-outline-danger btn-sm" title="{{ trans('app.delete_title') }}">
                    <i class="ti-trash"></i>
                </button>
                
            {!! Form::close() !!}
        </li>
        @endcan
    @else
        @can('mayors.create')
        <li class="list-inline-item">
            <button class="btn btn-outline-secondary btn-sm" 
            onclick="createMayor({{ $depto }}, {{ $muni }})">
                <span class="ti-plus"></span>
            </button>
        </li>
        @endcan
    @endif
</ul>