@extends('layouts.admin')
@section('content')
@can('taxonomy_profession_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-professions.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyProfession.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyProfession">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyProfessions as $key => $taxonomyProfession)
                        <tr data-entry-id="{{ $taxonomyProfession->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyProfession->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_profession_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-professions.show', $taxonomyProfession->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_profession_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-professions.edit', $taxonomyProfession->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_profession_delete')
                                    <form action="{{ route('admin.taxonomy-professions.destroy', $taxonomyProfession->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-professions',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
