@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyPaymentType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-payment-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPaymentType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyPaymentType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPaymentType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyPaymentType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPaymentType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyPaymentType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPaymentType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyPaymentType->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPaymentType.fields.field_cc') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyPaymentType->field_cc ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPaymentType.fields.field_online_only') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyPaymentType->field_online_only ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-payment-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection