@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseTopic.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.course-topics.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.id') }}
                        </th>
                        <td>
                            {{ $courseTopic->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.title') }}
                        </th>
                        <td>
                            {{ $courseTopic->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.body') }}
                        </th>
                        <td>
                            {!! $courseTopic->body !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_speakers') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_speakers }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_ad_code') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_ad_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_supplier_code') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_supplier_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_on_sale') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseTopic->field_on_sale ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_position') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_volume') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_volume }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_issue') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_issue }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_course_type') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_course_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_course_credit_type') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_course_credit_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_practice_type') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_practice_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_armscode') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_armscode->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_web_category') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_web_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_ad_service') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_ad_service->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_media_provider') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_media_provider->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_media_provider_topic') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_media_provider_topic }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_aana_expiration_date') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_aana_expiration_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_expiration_date') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_expiration_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_price') }}
                        </th>
                        <td>
                            {{ $courseTopic->field_price }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.course-topics.index')])
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
            <a class="nav-link" href="#field_topics_nodes_course_products" role="tab" data-toggle="tab">
                {{ trans('cruds.courseProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_topics_nodes_course_products">
            @includeIf('admin.courseTopics.relationships.fieldTopicsNodesCourseProducts', ['courseProducts' => $courseTopic->fieldTopicsNodesCourseProducts])
        </div>
    </div>
</div>

@endsection
