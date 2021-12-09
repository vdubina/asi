@extends('layouts.admin')
@section('content')
@can('taxonomy_coupon_code_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.taxonomy-coupon-codes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.taxonomyCouponCode.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyCouponCode.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-TaxonomyCouponCode">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyCouponCodes as $key => $taxonomyCouponCode)
                        <tr data-entry-id="{{ $taxonomyCouponCode->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyCouponCode->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_coupon_code_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-coupon-codes.show', $taxonomyCouponCode->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_coupon_code_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-coupon-codes.edit', $taxonomyCouponCode->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_coupon_code_delete')
                                    <form action="{{ route('admin.taxonomy-coupon-codes.destroy', $taxonomyCouponCode->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('taxonomy_coupon_code_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.taxonomy-coupon-codes.massDestroy') }}",
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
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-TaxonomyCouponCode:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection