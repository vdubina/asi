@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.structure.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.structures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.structure.fields.id') }}
                        </th>
                        <td>
                            {{ $structure->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.structure.fields.label') }}
                        </th>
                        <td>
                            {{ $structure->label }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.structure.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Structure::TYPE_SELECT[$structure->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.structure.fields.link') }}
                        </th>
                        <td>
                            {{ $structure->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.structure.fields.external') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $structure->external ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.structure.fields.page') }}
                        </th>
                        <td>
                            {{ $structure->page->title ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.structures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection