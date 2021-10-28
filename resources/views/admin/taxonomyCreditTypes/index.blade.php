@extends('layouts.admin')
@section('content')
@can('taxonomy_credit_type_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.taxonomy-credit-types.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.taxonomyCreditType.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyCreditType">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.taxonomyCreditType.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taxonomyCreditTypes as $key => $taxonomyCreditType)
                        <tr data-entry-id="{{ $taxonomyCreditType->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $taxonomyCreditType->name ?? '' }}
                            </td>
                            <td>
                                @can('taxonomy_credit_type_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-credit-types.show', $taxonomyCreditType->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('taxonomy_credit_type_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-credit-types.edit', $taxonomyCreditType->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('taxonomy_credit_type_delete')
                                    <form action="{{ route('admin.taxonomy-credit-types.destroy', $taxonomyCreditType->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-credit-types',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
