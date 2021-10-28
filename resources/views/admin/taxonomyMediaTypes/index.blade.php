@extends('layouts.admin')
@section('content')
@can('taxonomy_media_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-media-types.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyMediaType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyMediaType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyMediaType.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyMediaTypes as $key => $taxonomyMediaType)
                        <tr data-entry-id="{{ $taxonomyMediaType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyMediaType->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_media_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-media-types.show', $taxonomyMediaType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_media_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-media-types.edit', $taxonomyMediaType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_media_type_delete')
                                    <form action="{{ route('admin.taxonomy-media-types.destroy', $taxonomyMediaType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-media-types',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
