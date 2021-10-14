@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.testimonial.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.testimonials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.id') }}
                        </th>
                        <td>
                            {{ $testimonial->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.title') }}
                        </th>
                        <td>
                            {{ $testimonial->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.page_text') }}
                        </th>
                        <td>
                            {!! $testimonial->page_text !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.featured_image') }}
                        </th>
                        <td>
                            @if($testimonial->featured_image)
                                <a href="{{ $testimonial->featured_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $testimonial->featured_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.field_label') }}
                        </th>
                        <td>
                            {{ $testimonial->field_label }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.field_show_in_slider') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $testimonial->field_show_in_slider ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.field_testimonial_type') }}
                        </th>
                        <td>
                            @foreach($testimonial->field_testimonial_types as $key => $field_testimonial_type)
                                <span class="label label-info">{{ $field_testimonial_type->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.testimonial.fields.show_on_pages') }}
                        </th>
                        <td>
                            @foreach($testimonial->show_on_pages as $key => $show_on_pages)
                                <span class="label label-info">{{ $show_on_pages->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.testimonials.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
