<button class="btn btn100 btn-success" type="button" id="{{ $id ?? ''}}" onclick="{{ $click ?? 'document.location.href="'.($url ?? '#').'"' }}">
    <em class="far fa-fw fa-plus"></em> {{ trans('global.add_new') }}
</button>
