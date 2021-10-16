@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.testimonialType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.testimonial-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonialType.fields.id') }}
                        </th>
                        <td>
                            {{ $testimonialType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonialType.fields.name') }}
                        </th>
                        <td>
                            {{ $testimonialType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonialType.fields.description') }}
                        </th>
                        <td>
                            {!! $testimonialType->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.testimonial-types.index') }}">
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
            <a class="nav-link" href="#field_testimonial_type_testimonials" role="tab" data-toggle="tab">
                {{ trans('cruds.testimonial.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_testimonial_type_testimonials">
            @includeIf('admin.testimonialTypes.relationships.fieldTestimonialTypeTestimonials', ['testimonials' => $testimonialType->fieldTestimonialTypeTestimonials])
        </div>
    </div>
</div>

@endsection
