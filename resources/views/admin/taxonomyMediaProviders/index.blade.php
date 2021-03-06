@extends('layouts.admin')
@section('content')
@can('taxonomy_media_provider_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-media-providers.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyMediaProvider.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyMediaProvider">
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
    @include('partials.scripts.dataTableButtons', [
     'route'=>'taxonomy-media-providers',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
