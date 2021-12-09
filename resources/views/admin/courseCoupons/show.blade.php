@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.courseCoupon.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-coupons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.id') }}
                        </th>
                        <td>
                            {{ $courseCoupon->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.code') }}
                        </th>
                        <td>
                            {{ $courseCoupon->code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.uses') }}
                        </th>
                        <td>
                            {{ $courseCoupon->uses }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $courseCoupon->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\CourseCoupon::TYPE_SELECT[$courseCoupon->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.amount') }}
                        </th>
                        <td>
                            {{ $courseCoupon->amount }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseCoupon->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.on_demand') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseCoupon->on_demand ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.invert') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseCoupon->invert ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.exclusive') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $courseCoupon->exclusive ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.date_from') }}
                        </th>
                        <td>
                            {{ $courseCoupon->date_from }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.date_to') }}
                        </th>
                        <td>
                            {{ $courseCoupon->date_to }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.media_type') }}
                        </th>
                        <td>
                            {{ $courseCoupon->media_type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.products') }}
                        </th>
                        <td>
                            @foreach($courseCoupon->products as $key => $products)
                                <span class="label label-info">{{ $products->sku }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.prev_days_less') }}
                        </th>
                        <td>
                            {{ $courseCoupon->prev_days_less }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.prev_days_more') }}
                        </th>
                        <td>
                            {{ $courseCoupon->prev_days_more }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.course-coupons.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection