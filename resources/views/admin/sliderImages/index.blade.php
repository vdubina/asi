@extends('layouts.admin')
@section('content')
@can('slider_image_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.slider-images.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sliderImage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-SliderImage">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sliderImage.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.sliderImage.fields.field_weight') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sliderImages as $key => $sliderImage)
                        <tr data-entry-id="{{ $sliderImage->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $sliderImage->title ?? '' }}
                            </td>
                            <td>
                                {{ $sliderImage->field_weight ?? '' }}
                            </td>
                            <td>
                                @can('slider_image_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.slider-images.show', $sliderImage->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('slider_image_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.slider-images.edit', $sliderImage->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('slider_image_delete')
                                    <form action="{{ route('admin.slider-images.destroy', $sliderImage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    @include('partials.scripts.dataTableButtons', [
     'route'=>'slider-images',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
