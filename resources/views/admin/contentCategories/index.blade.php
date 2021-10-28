@extends('layouts.admin')
@section('content')
@can('content_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.content-categories.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.contentCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-ContentCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.contentCategory.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contentCategories as $key => $contentCategory)
                        <tr data-entry-id="{{ $contentCategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $contentCategory->name ?? '' }}
                            </td>
                            <td>
                                @can('content_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.content-categories.show', $contentCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('content_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.content-categories.edit', $contentCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('content_category_delete')
                                    <form action="{{ route('admin.content-categories.destroy', $contentCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    @include('partials.scripts.dataTableButtons', [
     'route'=>'content-categories',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
