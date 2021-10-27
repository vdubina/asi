@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.slider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.sliders.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.id') }}
                        </th>
                        <td>
                            {{ $slider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.name') }}
                        </th>
                        <td>
                            {{ $slider->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.description') }}
                        </th>
                        <td>
                            {!! $slider->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.slider.fields.field_is_subsite_content') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $slider->field_is_subsite_content ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.sliders.index')])
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
            <a class="nav-link" href="#field_slider_slider_images" role="tab" data-toggle="tab">
                {{ trans('cruds.sliderImage.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_slider_slider_images">
            @includeIf('admin.sliders.relationships.fieldSliderSliderImages', ['sliderImages' => $slider->fieldSliderSliderImages])
        </div>
    </div>
</div>

@endsection
