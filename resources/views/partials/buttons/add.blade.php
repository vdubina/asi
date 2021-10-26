<button class="btn btn100 btn-success" type="button" id="{{ $id ?? ''}}" onclick="{{ $click ?? 'document.location.href="'.($url ?? '#').'"' }}">
    <i class="far fa-fw fa-plus"></i> {{ trans('global.add_new') }}
</button>
