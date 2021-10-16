@extends('layouts.admin')
@section('content')
@can('taxonomy_media_provider_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.taxonomy-media-providers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.taxonomyMediaProvider.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyMediaProvider.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-striped compact table-hover datatable datatable-TaxonomyMediaProvider">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyMediaProvider.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyMediaProviders as $key => $taxonomyMediaProvider)
                        <tr data-entry-id="{{ $taxonomyMediaProvider->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyMediaProvider->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_media_provider_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-media-providers.show', $taxonomyMediaProvider->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_media_provider_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-media-providers.edit', $taxonomyMediaProvider->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_media_provider_delete')
                                    <form action="{{ route('admin.taxonomy-media-providers.destroy', $taxonomyMediaProvider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('taxonomy_media_provider_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.taxonomy-media-providers.massDestroy') }}",
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
  let table = $('.datatable-TaxonomyMediaProvider:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
