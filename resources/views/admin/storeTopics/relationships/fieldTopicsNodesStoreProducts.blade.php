<div class="m-3">
    @can('store_product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.store-products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.storeProduct.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.storeProduct.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-fieldTopicsNodesStoreProducts">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.storeProduct.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.storeProduct.fields.sku') }}
                            </th>
                            <th>
                                {{ trans('cruds.storeProduct.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.storeProduct.fields.commerce_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.storeProduct.fields.status') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($storeProducts as $key => $storeProduct)
                            <tr data-entry-id="{{ $storeProduct->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $storeProduct->id ?? '' }}
                                </td>
                                <td>
                                    {{ $storeProduct->sku ?? '' }}
                                </td>
                                <td>
                                    {{ $storeProduct->title ?? '' }}
                                </td>
                                <td>
                                    {{ $storeProduct->commerce_price ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $storeProduct->status ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $storeProduct->status ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('store_product_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.store-products.show', $storeProduct->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('store_product_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.store-products.edit', $storeProduct->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('store_product_delete')
                                        <form action="{{ route('admin.store-products.destroy', $storeProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('store_product_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.store-products.massDestroy') }}",
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
  let table = $('.datatable-fieldTopicsNodesStoreProducts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection