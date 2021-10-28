@extends('layouts.admin')
@section('content')
@can('taxonomy_web_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-web-categories.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyWebCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyWebCategory">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyWebCategory.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyWebCategories as $key => $taxonomyWebCategory)
                        <tr data-entry-id="{{ $taxonomyWebCategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyWebCategory->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_web_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-web-categories.show', $taxonomyWebCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_web_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-web-categories.edit', $taxonomyWebCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_web_category_delete')
                                    <form action="{{ route('admin.taxonomy-web-categories.destroy', $taxonomyWebCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-web-categories',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
