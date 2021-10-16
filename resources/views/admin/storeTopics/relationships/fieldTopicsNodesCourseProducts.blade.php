<div class="m-3">
    @can('course_product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.course-products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.courseProduct.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.courseProduct.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-striped compact table-hover datatable datatable-fieldTopicsNodesCourseProducts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.sku') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.commerce_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courseProducts as $key => $courseProduct)
                            <tr data-entry-id="{{ $courseProduct->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $courseProduct->id ?? '' }}
                                </td>
                                <td>
                                    {{ $courseProduct->sku ?? '' }}
                                </td>
                                <td>
                                    {{ $courseProduct->title ?? '' }}
                                </td>
                                <td>
                                    {{ $courseProduct->commerce_price ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $courseProduct->status ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $courseProduct->status ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('course_product_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.course-products.show', $courseProduct->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('course_product_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.course-products.edit', $courseProduct->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('course_product_delete')
                                        <form action="{{ route('admin.course-products.destroy', $courseProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('course_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.course-products.massDestroy') }}",
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
  let table = $('.datatable-fieldTopicsNodesCourseProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
