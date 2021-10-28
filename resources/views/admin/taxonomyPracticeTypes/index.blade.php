@extends('layouts.admin')
@section('content')
@can('taxonomy_practice_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-practice-types.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyPracticeType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyPracticeType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyPracticeType.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyPracticeTypes as $key => $taxonomyPracticeType)
                        <tr data-entry-id="{{ $taxonomyPracticeType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyPracticeType->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_practice_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-practice-types.show', $taxonomyPracticeType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_practice_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-practice-types.edit', $taxonomyPracticeType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_practice_type_delete')
                                    <form action="{{ route('admin.taxonomy-practice-types.destroy', $taxonomyPracticeType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-practice-types',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
