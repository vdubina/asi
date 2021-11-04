@extends('layouts.admin')
@section('content')
@can('course_coupon_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.course-coupons.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.courseCoupon.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-CourseCoupon">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.code') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.amount') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseCoupon.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courseCoupons as $key => $courseCoupon)
                        <tr data-entry-id="{{ $courseCoupon->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $courseCoupon->code ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\CourseCoupon::TYPE_SELECT[$courseCoupon->type] ?? '' }}
                            </td>
                            <td>
                                {{ $courseCoupon->amount ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $courseCoupon->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $courseCoupon->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('course_coupon_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.course-coupons.show', $courseCoupon->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('course_coupon_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.course-coupons.edit', $courseCoupon->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('course_coupon_delete')
                                    <form action="{{ route('admin.course-coupons.destroy', $courseCoupon->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'course-coupons',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
