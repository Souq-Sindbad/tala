<div class="btn-group">
    <button type="button" class="btn btn-primary">@lang('site.action')</button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
        <span class="sr-only"></span>
    </button>
    <div class="dropdown-menu" role="menu">
        @if (auth()->user()->hasPermission('benefits-update'))
            <a onclick="return edit_row('{{ route(env('DASH_URL').'.benefits.edit',$id) }}')" class="dropdown-item"
               href="#">@lang('site.edit')</a>
            @if($status == 1)
                <a onclick="status_row('{{ route(env('DASH_URL').'.benefits.block',$id) }}',0)" class="dropdown-item"
                   href="#">@lang('site.block')</a>
            @else
                <a onclick="status_row('{{ route(env('DASH_URL').'.benefits.active',$id) }}',1)" class="dropdown-item"
                   href="#">@lang('site.active')</a>
            @endif
        @endif

        @if (auth()->user()->hasPermission('benefits-delete'))
            <form onsubmit="return delete_process('{{ route(env('DASH_URL').'.benefits.remove',$id) }}')" id="delete-{{ $id }}"
                  class="delete-form"
                  action="{{ route(env('DASH_URL').'.benefits.remove',$id) }}"
                  method="post" style="display: inline-block">
                {{ csrf_field() }}
                {{ method_field('delete') }}
                <a class="dropdown-item" onclick="delete_row({{ $id }})" href="#">@lang('site.delete')</a>
            </form>
        @endif
    </div>
</div>
