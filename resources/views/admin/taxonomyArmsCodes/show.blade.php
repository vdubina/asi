@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyArmsCode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-arms-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCode.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyArmsCode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCode.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyArmsCode->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCode.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyArmsCode->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCode.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyArmsCode->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCode.fields.field_arms_category') }}
                        </th>
                        <td>
                            {{ $taxonomyArmsCode->field_arms_category->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-arms-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#field_armscode_course_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.courseTopic.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_armscode_course_topics">
            @includeIf('admin.taxonomyArmsCodes.relationships.fieldArmscodeCourseTopics', ['courseTopics' => $taxonomyArmsCode->fieldArmscodeCourseTopics])
        </div>
    </div>
</div>

@endsection