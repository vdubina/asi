@extends('layouts.admin')
@section('content')
@can('taxonomy_content_block_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-content-block-types.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyContentBlockType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyContentBlockType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyContentBlockType.fields.name') }}
                        </th>
                        <th width="20">
                            {{ trans('cruds.taxonomyContentBlockType.fields.id') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyContentBlockTypes as $key => $taxonomyContentBlockType)
                        <tr data-entry-id="{{ $taxonomyContentBlockType->id }}">
                            <td>

                            </td>
                            <td>
                                <i class="fa-fw nav-icon fas fa-{{ $taxonomyContentBlockType->fa_icon }}"></i>
                                {{ $taxonomyContentBlockType->name ?? '' }}
                            </td>
                            <td>
                                {{ $taxonomyContentBlockType->id ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_content_block_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-content-block-types.show', $taxonomyContentBlockType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_content_block_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-content-block-types.edit', $taxonomyContentBlockType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_content_block_type_delete')
                                    <form action="{{ route('admin.taxonomy-content-block-types.destroy', $taxonomyContentBlockType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-content-block-types',
     'order'=>'[[ 2, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
