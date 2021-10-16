@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyCourseType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-course-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourseType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyCourseType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourseType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyCourseType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourseType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyCourseType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourseType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyCourseType->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourseType.fields.field_adsubscribable') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyCourseType->field_adsubscribable ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourseType.fields.field_custom_course_layout') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyCourseType->field_custom_course_layout ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-course-types.index') }}">
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
            <a class="nav-link" href="#field_course_type_taxonomy_courses" role="tab" data-toggle="tab">
                {{ trans('cruds.taxonomyCourse.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#field_course_type_course_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.courseTopic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#field_course_type_course_products" role="tab" data-toggle="tab">
                {{ trans('cruds.courseProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_course_type_taxonomy_courses">
            @includeIf('admin.taxonomyCourseTypes.relationships.fieldCourseTypeTaxonomyCourses', ['taxonomyCourses' => $taxonomyCourseType->fieldCourseTypeTaxonomyCourses])
        </div>
        <div class="tab-pane" role="tabpanel" id="field_course_type_course_topics">
            @includeIf('admin.taxonomyCourseTypes.relationships.fieldCourseTypeCourseTopics', ['courseTopics' => $taxonomyCourseType->fieldCourseTypeCourseTopics])
        </div>
        <div class="tab-pane" role="tabpanel" id="field_course_type_course_products">
            @includeIf('admin.taxonomyCourseTypes.relationships.fieldCourseTypeCourseProducts', ['courseProducts' => $taxonomyCourseType->fieldCourseTypeCourseProducts])
        </div>
    </div>
</div>

@endsection
