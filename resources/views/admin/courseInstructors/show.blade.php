@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseInstructor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-instructors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInstructor.fields.id') }}
                        </th>
                        <td>
                            {{ $courseInstructor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInstructor.fields.name') }}
                        </th>
                        <td>
                            {{ $courseInstructor->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInstructor.fields.description') }}
                        </th>
                        <td>
                            {!! $courseInstructor->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInstructor.fields.field_image') }}
                        </th>
                        <td>
                            @if($courseInstructor->field_image)
                                <a href="{{ $courseInstructor->field_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $courseInstructor->field_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseInstructor.fields.field_course_products') }}
                        </th>
                        <td>
                            @foreach($courseInstructor->field_course_products as $key => $field_course_products)
                                <span class="label label-info">{{ $field_course_products->sku }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-instructors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
