<button class="btn btn100 btn-success" type="{{ $type ?? 'submit' }}" id="{{ $id ?? ''}}" onclick="{{ $click ?? '' }}">
    <em class="far fa-fw fa-save"></em> {{ trans('global.save') }}
</button>
