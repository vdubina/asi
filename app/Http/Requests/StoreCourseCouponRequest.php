<?php

namespace App\Http\Requests;

use App\Models\CourseCoupon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCourseCouponRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('course_coupon_create');
    }

    public function rules()
    {
        return [
            'code' => [
                'string',
                'min:2',
                'max:40',
                'nullable',
            ],
            'uses' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'field_offsiteid' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
            'amount' => [
                'numeric',
                'min:0',
            ],
            'date_from' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'date_to' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'products.*' => [
                'integer',
            ],
            'products' => [
                'array',
            ],
            'prev_days_less' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'prev_days_more' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
