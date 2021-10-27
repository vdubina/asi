@extends('layouts.admin')
@section('content')
@can('content_block_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.content-blocks.create', $contentBlockType->id)])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{$contentBlockType->name}} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-ContentBlock">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contentBlock.fields.title') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contentBlocks as $key => $contentBlock)
                        <tr data-entry-id="{{ $contentBlock->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $contentBlock->title ?? '' }}
                            </td>
                            <td>
                                @can('content_block_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.content-blocks.show', ['content_block_type'=>$contentBlockType->id, 'content_block'=>$contentBlock->id]) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('content_block_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.content-blocks.edit', ['content_block_type'=>$contentBlockType->id, 'content_block'=>$contentBlock->id]) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('content_block_delete')
                                    <form action="{{ route('admin.content-blocks.destroy', ['content_block_type'=>$contentBlockType->id, 'content_block'=>$contentBlock->id]) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('content_block_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.content-blocks.massDestroy') }}",
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
  let table = $('.datatable-ContentBlock:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

})

</script>
@endsection
