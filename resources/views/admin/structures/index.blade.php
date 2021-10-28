@extends('layouts.admin')
@section('content')
    @can('structure_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.structures.create')])
                @include('partials.buttons.reorder', ['url'=>route('admin.structures.reorder')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.structure.title_singular') }}
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class=" {{ config('panel.datatables.css') }} datatable-Structure">
                    <thead>
                    <tr>
                        <th style="display:none">

                        </th>
                        <th>
                            {{ trans('cruds.structure.fields.label') }}
                        </th>
                        <th>
                            {{ trans('cruds.structure.fields.type') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($structures as $key => $structure)
                        <tr data-entry-id="{{ $structure->id }}">
                            <td style="display:none">

                            </td>
                            <td>
                                <i class="fas fa-fw fa-caret-right text-blue"></i>
                                @foreach($structure->ancestors as $a)
                                    <i class="fas fa-fw fa-caret-right text-blue"></i>
                                @endforeach
                                {{ $structure->label ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\Structure::TYPE_SELECT[$structure->type] ?? '' }}
                            </td>
                            <td>
                                @can('structure_show')
                                    <a class="btn btn-xs btn-primary"
                                       href="{{ route('admin.structures.show', $structure->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('structure_edit')
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('admin.structures.edit', $structure->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('structure_delete')
                                    <form action="{{ route('admin.structures.destroy', $structure->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSureDeleteNested') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                               value="{{ trans('global.delete') }}">
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
     'route'=>'structures',
     'order'=>'[[ 2, "desc" ]]',
     'pageLength'=>100
    ])
@endsection
