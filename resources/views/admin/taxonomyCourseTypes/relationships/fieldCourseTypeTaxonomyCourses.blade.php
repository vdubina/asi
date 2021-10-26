<div class="m-3">
    @can('taxonomy_course_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.taxonomy-courses.create')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.taxonomyCourse.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-striped compact table-hover datatable datatable-fieldCourseTypeTaxonomyCourses">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.taxonomyCourse.fields.name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taxonomyCourses as $key => $taxonomyCourse)
                            <tr data-entry-id="{{ $taxonomyCourse->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $taxonomyCourse->name ?? '' }}
                                </td>
                                <td>
                                    @can('taxonomy_course_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-courses.show', $taxonomyCourse->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('taxonomy_course_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-courses.edit', $taxonomyCourse->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('taxonomy_course_delete')
                                        <form action="{{ route('admin.taxonomy-courses.destroy', $taxonomyCourse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('taxonomy_course_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.taxonomy-courses.massDestroy') }}",
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
  let table = $('.datatable-fieldCourseTypeTaxonomyCourses:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
