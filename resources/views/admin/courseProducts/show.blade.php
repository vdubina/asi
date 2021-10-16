@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseProduct.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.id') }}
                        </th>
                        <td>
                            {{ $courseProduct->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.title') }}
                        </th>
                        <td>
                            {{ $courseProduct->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.sku') }}
                        </th>
                        <td>
                            {{ $courseProduct->sku }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.commerce_price') }}
                        </th>
                        <td>
                            {{ $courseProduct->commerce_price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.status') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseProduct->status ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_description') }}
                        </th>
                        <td>
                            {!! $courseProduct->field_description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_course_length') }}
                        </th>
                        <td>
                            {{ App\Models\CourseProduct::FIELD_COURSE_LENGTH_SELECT[$courseProduct->field_course_length] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_supplier_code') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_supplier_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_is_ondemand') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseProduct->field_is_ondemand ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_disk_availability') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseProduct->field_disk_availability ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_dental_report_text') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_dental_report_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_download_availability') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_download_availability }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_standard_credit_hours') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_standard_credit_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_course_type') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_course_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_course_credit_type') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_course_credit_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_practice_type') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_practice_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_media_provider') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_media_provider->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_media_delivery_type') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_media_delivery_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_web_category') }}
                        </th>
                        <td>
                            {{ $courseProduct->field_web_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseProduct.fields.field_topics_nodes') }}
                        </th>
                        <td>
                            @foreach($courseProduct->field_topics_nodes as $key => $field_topics_nodes)
                                <span class="label label-info">{{ $field_topics_nodes->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-products.index') }}">
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
            <a class="nav-link" href="#field_course_products_course_instructors" role="tab" data-toggle="tab">
                {{ trans('cruds.courseInstructor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_course_products_course_instructors">
            @includeIf('admin.courseProducts.relationships.fieldCourseProductsCourseInstructors', ['courseInstructors' => $courseProduct->fieldCourseProductsCourseInstructors])
        </div>
    </div>
</div>

@endsection
