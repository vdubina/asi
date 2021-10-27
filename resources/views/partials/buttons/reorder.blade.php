<button class="btn btn100 btn-default" type="button" id="{{ $id ?? 'reorderBtn'}}" onclick="{{ $click ?? 'document.location.href="'.($url ?? '#').'"' }}">
    <em class="far fa-fw fa-random"></em> {{ trans('global.reorder') }}
</button>
