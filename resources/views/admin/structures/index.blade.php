@extends('layouts.admin')
@section('content')
@can('structure_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.structures.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.structure.title_node') }}
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
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.structure.fields.id') }}
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
                            <td>

                            </td>
                            <td>
                                {{ $structure->id ?? '' }}
                            </td>
                            <td>
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
                                    <form action="{{ route('admin.structures.destroy', $structure->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('structure_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.structures.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Structure:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
