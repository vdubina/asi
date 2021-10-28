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
                <table class=" {{ config('panel.datatables.css') }} datatable-ContentPage">
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
    @include('partials.scripts.dataTableButtons', [
     'route'=>'content-pages',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
