<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCourseCouponRequest;
use App\Http\Requests\StoreCourseCouponRequest;
use App\Http\Requests\UpdateCourseCouponRequest;
use App\Models\CourseCoupon;
use App\Models\CourseProduct;
use App\Models\TaxonomyMediaType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseCouponController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('course_coupon_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseCoupons = CourseCoupon::with(['media_type', 'products'])->get();

        return view('admin.courseCoupons.index', compact('courseCoupons'));
    }

    public function create()
    {
        abort_if(Gate::denies('course_coupon_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $media_types = TaxonomyMediaType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = CourseProduct::pluck('sku', 'id');

        return view('admin.courseCoupons.create', compact('media_types', 'products'));
    }

    public function store(StoreCourseCouponRequest $request)
    {
        $courseCoupon = CourseCoupon::create($request->all());
        $courseCoupon->products()->sync($request->input('products', []));

        return redirect()->route('admin.course-coupons.index');
    }

    public function edit(CourseCoupon $courseCoupon)
    {
        abort_if(Gate::denies('course_coupon_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $media_types = TaxonomyMediaType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $products = CourseProduct::pluck('sku', 'id');

        $courseCoupon->load('media_type', 'products');

        return view('admin.courseCoupons.edit', compact('media_types', 'products', 'courseCoupon'));
    }

    public function update(UpdateCourseCouponRequest $request, CourseCoupon $courseCoupon)
    {
        $courseCoupon->update($request->all());
        $courseCoupon->products()->sync($request->input('products', []));

        return redirect()->route('admin.course-coupons.index');
    }

    public function show(CourseCoupon $courseCoupon)
    {
        abort_if(Gate::denies('course_coupon_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseCoupon->load('media_type', 'products');

        return view('admin.courseCoupons.show', compact('courseCoupon'));
    }

    public function destroy(CourseCoupon $courseCoupon)
    {
        abort_if(Gate::denies('course_coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courseCoupon->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseCouponRequest $request)
    {
        CourseCoupon::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
