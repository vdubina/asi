@extends('layouts.admin')
@section('content')
@can('taxonomy_ad_service_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-ad-services.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyAdService.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyAdService">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyAdService.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyAdServices as $key => $taxonomyAdService)
                        <tr data-entry-id="{{ $taxonomyAdService->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyAdService->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_ad_service_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-ad-services.show', $taxonomyAdService->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_ad_service_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-ad-services.edit', $taxonomyAdService->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_ad_service_delete')
                                    <form action="{{ route('admin.taxonomy-ad-services.destroy', $taxonomyAdService->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-ad-services',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
