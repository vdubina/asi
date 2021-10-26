<div class="m-3">
    @can('content_page_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.content-pages.create')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.contentPage.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-striped compact table-hover datatable datatable-fieldTagsContentPages">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.contentPage.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.contentPage.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.contentPage.fields.field_is_subsite_content') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contentPages as $key => $contentPage)
                            <tr data-entry-id="{{ $contentPage->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $contentPage->id ?? '' }}
                                </td>
                                <td>
                                    {{ $contentPage->title ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $contentPage->field_is_subsite_content ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $contentPage->field_is_subsite_content ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('content_page_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.content-pages.show', $contentPage->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('content_page_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.content-pages.edit', $contentPage->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('content_page_delete')
                                        <form action="{{ route('admin.content-pages.destroy', $contentPage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('content_page_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.content-pages.massDestroy') }}",
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
  let table = $('.datatable-fieldTagsContentPages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
