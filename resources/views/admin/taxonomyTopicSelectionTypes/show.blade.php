@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyTopicSelectionType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-topic-selection-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTopicSelectionType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyTopicSelectionType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTopicSelectionType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyTopicSelectionType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTopicSelectionType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyTopicSelectionType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTopicSelectionType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyTopicSelectionType->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTopicSelectionType.fields.field_sort_order') }}
                        </th>
                        <td>
                            {{ $taxonomyTopicSelectionType->field_sort_order }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-topic-selection-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection