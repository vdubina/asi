@extends('layouts.admin')
@section('content')
@can('taxonomy_address_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-address-types.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyAddressType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyAddressType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyAddressType.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyAddressTypes as $key => $taxonomyAddressType)
                        <tr data-entry-id="{{ $taxonomyAddressType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyAddressType->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_address_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-address-types.show', $taxonomyAddressType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_address_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-address-types.edit', $taxonomyAddressType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_address_type_delete')
                                    <form action="{{ route('admin.taxonomy-address-types.destroy', $taxonomyAddressType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-address-types',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
