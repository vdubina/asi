@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyMediaDelivery.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-media-deliveries.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaDelivery.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaDelivery->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaDelivery.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaDelivery->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaDelivery.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyMediaDelivery->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaDelivery.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaDelivery->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaDelivery.fields.field_isshipped') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyMediaDelivery->field_isshipped ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-media-deliveries.index')])
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
            <a class="nav-link" href="#field_media_delivery_type_course_products" role="tab" data-toggle="tab">
                {{ trans('cruds.courseProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_media_delivery_type_course_products">
            @includeIf('admin.taxonomyMediaDeliveries.relationships.fieldMediaDeliveryTypeCourseProducts', ['courseProducts' => $taxonomyMediaDelivery->fieldMediaDeliveryTypeCourseProducts])
        </div>
    </div>
</div>

@endsection
