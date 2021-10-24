@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyCreditType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-credit-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCreditType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyCreditType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCreditType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyCreditType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCreditType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyCreditType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCreditType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyCreditType->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-credit-types.index') }}">
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
            <a class="nav-link" href="#field_course_credit_type_course_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.courseTopic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#field_course_credit_type_course_products" role="tab" data-toggle="tab">
                {{ trans('cruds.courseProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_course_credit_type_course_topics">
            @includeIf('admin.taxonomyCreditTypes.relationships.fieldCourseCreditTypeCourseTopics', ['courseTopics' => $taxonomyCreditType->fieldCourseCreditTypeCourseTopics])
        </div>
        <div class="tab-pane" role="tabpanel" id="field_course_credit_type_course_products">
            @includeIf('admin.taxonomyCreditTypes.relationships.fieldCourseCreditTypeCourseProducts', ['courseProducts' => $taxonomyCreditType->fieldCourseCreditTypeCourseProducts])
        </div>
    </div>
</div>

@endsection