@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn100 btn-success" href="javascript://" onclick="$('#toArray').click();">
            {{ trans('global.save') }}
        </a>
        <a class="btn btn100 btn-info" href="{{ route('admin.structures.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
</div>
<div class="card">
    <div class="card-header">
        {{ trans('global.reorder') }} {{ trans('cruds.structure.title_singular') }}
    </div>
    <div class="card-body">
        <ol class="sortable">
            @foreach($structures as $key => $node)
            <li id="list_{{ $node->id ?? '' }}">
                <div><i class="fas fa-fw fa-arrows-alt"></i> {{ $node->label }}</div>
                {!! NestedTreeHelper::listDescendants($node) !!}
            </li>
            @endforeach
        </ol>

        <a id="toArray" class="btn btn100 btn-success" href="javascript://">
            {{ trans('global.save') }}
        </a>
        <a class="btn btn100 btn-info" href="{{ route('admin.structures.index') }}">
            {{ trans('global.back_to_list') }}
        </a>
    </div>
</div>


@endsection
@section('scripts')
@parent
<script>
    $(document).ready(function () {
        setSortable(
            "#toArray",
            "{{ route('admin.structures.reorderStore') }}"
        )
    });
</script>
@endsection
