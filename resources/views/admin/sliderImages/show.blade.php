@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sliderImage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.slider-images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderImage.fields.id') }}
                        </th>
                        <td>
                            {{ $sliderImage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderImage.fields.title') }}
                        </th>
                        <td>
                            {{ $sliderImage->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderImage.fields.page_text') }}
                        </th>
                        <td>
                            {!! $sliderImage->page_text !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderImage.fields.field_slide_image') }}
                        </th>
                        <td>
                            @if($sliderImage->field_slide_image)
                                <a href="{{ $sliderImage->field_slide_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $sliderImage->field_slide_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderImage.fields.field_slider') }}
                        </th>
                        <td>
                            @foreach($sliderImage->field_sliders as $key => $field_slider)
                                <span class="label label-info">{{ $field_slider->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sliderImage.fields.field_weight') }}
                        </th>
                        <td>
                            {{ $sliderImage->field_weight }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.slider-images.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
