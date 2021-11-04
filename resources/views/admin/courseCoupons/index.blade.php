@extends('layouts.admin')
@section('content')
@can('course_coupon_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.course-coupons.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.courseCoupon.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.courseCoupon.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CourseCoupon">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courseCoupons as $key => $courseCoupon)
                        <tr data-entry-id="{{ $courseCoupon->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $courseCoupon->code ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CourseCoupon::TYPE_SELECT[$courseCoupon->type] ?? '' }}
                            </td>
                            <td>
                                {{ $courseCoupon->amount ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $courseCoupon->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $courseCoupon->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('course_coupon_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.course-coupons.show', $courseCoupon->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('course_coupon_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.course-coupons.edit', $courseCoupon->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('course_coupon_delete')
                                    <form action="{{ route('admin.course-coupons.destroy', $courseCoupon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('course_coupon_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.course-coupons.massDestroy') }}",
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
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-CourseCoupon:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection