<button class="btn btn100 btn-default" type="button" id="{{ $id ?? 'reorderBtn'}}" onclick="{{ $click ?? 'document.location.href="'.($url ?? '#').'"' }}">
    <i class="far fa-fw fa-random"></i> {{ trans('global.reorder') }}
</button>
