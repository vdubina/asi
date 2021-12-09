@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyCouponCode.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-coupon-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyCouponCode->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_value') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->field_value }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_type') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->field_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_max_uses') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->field_max_uses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_inactive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyCouponCode->field_inactive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_exclusive') }}
                        </th>
                        <td>
                            {{ App\Models\TaxonomyCouponCode::FIELD_EXCLUSIVE_RADIO[$taxonomyCouponCode->field_exclusive] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_date_start') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->field_date_start }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCouponCode.fields.field_date_end') }}
                        </th>
                        <td>
                            {{ $taxonomyCouponCode->field_date_end }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-coupon-codes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection