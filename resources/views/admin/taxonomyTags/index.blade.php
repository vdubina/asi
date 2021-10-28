@extends('layouts.admin')
@section('content')
@can('taxonomy_tag_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-tags.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyTag.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyTag">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyTag.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyTags as $key => $taxonomyTag)
                        <tr data-entry-id="{{ $taxonomyTag->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyTag->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_tag_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-tags.show', $taxonomyTag->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_tag_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-tags.edit', $taxonomyTag->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_tag_delete')
                                    <form action="{{ route('admin.taxonomy-tags.destroy', $taxonomyTag->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-tags',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
