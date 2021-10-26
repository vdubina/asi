@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        @include('partials.buttons.save', ['click'=>'$("#toArray").click();'])
        @include('partials.buttons.back', ['url'=>route('admin.structures.index')])
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

        @include('partials.buttons.save', ['id'=>'toArray'])
        @include('partials.buttons.back', ['url'=>route('admin.structures.index')])
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
