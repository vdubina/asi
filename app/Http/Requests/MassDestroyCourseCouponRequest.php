<?php

namespace App\Http\Requests;

use App\Models\CourseCoupon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCourseCouponRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('course_coupon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:course_coupons,id',
        ];
    }
}
