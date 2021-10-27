<button class="btn btn100 btn-default" type="button" id="{{ $id ?? 'backBtn'}}" onclick="document.location.href='{{$url ?? '#'}}'">
    <em class="far fa-fw fa-list"></em> {{ trans('global.back_to_list') }}
</button>
