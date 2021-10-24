@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyCourse.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyCourse->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyCourse->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyCourse->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.field_available') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyCourse->field_available ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.field_placeholder') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyCourse->field_placeholder ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.field_dental_report_text') }}
                        </th>
                        <td>
                            {{ $taxonomyCourse->field_dental_report_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.field_course_type') }}
                        </th>
                        <td>
                            {{ $taxonomyCourse->field_course_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCourse.fields.field_additional_information') }}
                        </th>
                        <td>
                            {!! $taxonomyCourse->field_additional_information !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-courses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection