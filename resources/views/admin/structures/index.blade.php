@extends('layouts.admin')
@section('content')
@can('structure_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn100 btn-success" href="{{ route('admin.structures.create') }}">
            {{ trans('global.add_new') }}
        </a>
        <a class="btn btn100 btn-info" href="{{ route('admin.structures.reorder') }}">
            {{ trans('global.reorder') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.structure.title_singular') }}
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-striped compact table-hover datatable datatable-Structure">
                <thead>
                <tr>
                    <th style="display:none">

                    </th>
                    <th>
                        {{ trans('cruds.structure.fields.label') }}
                    </th>
                    <th>
                        {{ trans('cruds.structure.fields.type') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($structures as $key => $structure)
                <tr data-entry-id="{{ $structure->id }}">
                    <td style="display:none">

                    </td>
                    <td>
                        @foreach($structure->ancestors as $a)
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        @endforeach
                        {{ $structure->label ?? '' }}
                    </td>
                    <td>
                        {{ App\Models\Structure::TYPE_SELECT[$structure->type] ?? '' }}
                    </td>
                    <td>
                        @can('structure_show')
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.structures.show', $structure->id) }}">
                            {{ trans('global.view') }}
                        </a>
                        @endcan

                        @can('structure_edit')
                        <a class="btn btn-xs btn-info" href="{{ route('admin.structures.edit', $structure->id) }}">
                            {{ trans('global.edit') }}
                        </a>
                        @endcan

                        @can('structure_delete')
                        <form action="{{ route('admin.structures.destroy', $structure->id) }}" method="POST"
                              onsubmit="return confirm('{{ trans('global.areYouSureDeleteNested') }}');"
                              style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                        </form>
                        @endcan

                    </td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection
@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            pageLength: 100,
        });
        let table = $('.datatable-Structure:not(.ajaxTable)').DataTable({ "bSort": false })
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });

    })

</script>
@endsection
