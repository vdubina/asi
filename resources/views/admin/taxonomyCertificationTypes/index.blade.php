@extends('layouts.admin')
@section('content')
@can('taxonomy_certification_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-certification-types.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyCertificationType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyCertificationType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyCertificationType.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyCertificationTypes as $key => $taxonomyCertificationType)
                        <tr data-entry-id="{{ $taxonomyCertificationType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyCertificationType->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_certification_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-certification-types.show', $taxonomyCertificationType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_certification_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-certification-types.edit', $taxonomyCertificationType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_certification_type_delete')
                                    <form action="{{ route('admin.taxonomy-certification-types.destroy', $taxonomyCertificationType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-certification-types',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
