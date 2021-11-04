@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.courseCoupon.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-coupons.update", [$courseCoupon->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="code">{{ trans('cruds.courseCoupon.fields.code') }}</label>
                <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', $courseCoupon->code) }}">
                @if($errors->has('code'))
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="uses">{{ trans('cruds.courseCoupon.fields.uses') }}</label>
                <input class="form-control {{ $errors->has('uses') ? 'is-invalid' : '' }}" type="number" name="uses" id="uses" value="{{ old('uses', $courseCoupon->uses) }}" step="1">
                @if($errors->has('uses'))
                    <span class="text-danger">{{ $errors->first('uses') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.uses_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_offsiteid">{{ trans('cruds.courseCoupon.fields.field_offsiteid') }}</label>
                <input class="form-control {{ $errors->has('field_offsiteid') ? 'is-invalid' : '' }}" type="text" name="field_offsiteid" id="field_offsiteid" value="{{ old('field_offsiteid', $courseCoupon->field_offsiteid) }}" required>
                @if($errors->has('field_offsiteid'))
                    <span class="text-danger">{{ $errors->first('field_offsiteid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.field_offsiteid_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.courseCoupon.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\CourseCoupon::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $courseCoupon->type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="amount">{{ trans('cruds.courseCoupon.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="number" name="amount" id="amount" value="{{ old('amount', $courseCoupon->amount) }}" step="0.01">
                @if($errors->has('amount'))
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $courseCoupon->active || old('active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.courseCoupon.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <span class="text-danger">{{ $errors->first('active') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('on_demand') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="on_demand" value="0">
                    <input class="form-check-input" type="checkbox" name="on_demand" id="on_demand" value="1" {{ $courseCoupon->on_demand || old('on_demand', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="on_demand">{{ trans('cruds.courseCoupon.fields.on_demand') }}</label>
                </div>
                @if($errors->has('on_demand'))
                    <span class="text-danger">{{ $errors->first('on_demand') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.on_demand_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('invert') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="invert" value="0">
                    <input class="form-check-input" type="checkbox" name="invert" id="invert" value="1" {{ $courseCoupon->invert || old('invert', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="invert">{{ trans('cruds.courseCoupon.fields.invert') }}</label>
                </div>
                @if($errors->has('invert'))
                    <span class="text-danger">{{ $errors->first('invert') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.invert_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('exclusive') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="exclusive" value="0">
                    <input class="form-check-input" type="checkbox" name="exclusive" id="exclusive" value="1" {{ $courseCoupon->exclusive || old('exclusive', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="exclusive">{{ trans('cruds.courseCoupon.fields.exclusive') }}</label>
                </div>
                @if($errors->has('exclusive'))
                    <span class="text-danger">{{ $errors->first('exclusive') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.exclusive_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_from">{{ trans('cruds.courseCoupon.fields.date_from') }}</label>
                <input class="form-control datetime {{ $errors->has('date_from') ? 'is-invalid' : '' }}" type="text" name="date_from" id="date_from" value="{{ old('date_from', $courseCoupon->date_from) }}">
                @if($errors->has('date_from'))
                    <span class="text-danger">{{ $errors->first('date_from') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.date_from_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_to">{{ trans('cruds.courseCoupon.fields.date_to') }}</label>
                <input class="form-control datetime {{ $errors->has('date_to') ? 'is-invalid' : '' }}" type="text" name="date_to" id="date_to" value="{{ old('date_to', $courseCoupon->date_to) }}">
                @if($errors->has('date_to'))
                    <span class="text-danger">{{ $errors->first('date_to') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.date_to_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="media_type_id">{{ trans('cruds.courseCoupon.fields.media_type') }}</label>
                <select class="form-control select2 {{ $errors->has('media_type') ? 'is-invalid' : '' }}" name="media_type_id" id="media_type_id">
                    @foreach($media_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('media_type_id') ? old('media_type_id') : $courseCoupon->media_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('media_type'))
                    <span class="text-danger">{{ $errors->first('media_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.media_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="products">{{ trans('cruds.courseCoupon.fields.products') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('products') ? 'is-invalid' : '' }}" name="products[]" id="products" multiple>
                    @foreach($products as $id => $product)
                        <option value="{{ $id }}" {{ (in_array($id, old('products', [])) || $courseCoupon->products->contains($id)) ? 'selected' : '' }}>{{ $product }}</option>
                    @endforeach
                </select>
                @if($errors->has('products'))
                    <span class="text-danger">{{ $errors->first('products') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.products_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prev_days_less">{{ trans('cruds.courseCoupon.fields.prev_days_less') }}</label>
                <input class="form-control {{ $errors->has('prev_days_less') ? 'is-invalid' : '' }}" type="number" name="prev_days_less" id="prev_days_less" value="{{ old('prev_days_less', $courseCoupon->prev_days_less) }}" step="1">
                @if($errors->has('prev_days_less'))
                    <span class="text-danger">{{ $errors->first('prev_days_less') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.prev_days_less_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="prev_days_more">{{ trans('cruds.courseCoupon.fields.prev_days_more') }}</label>
                <input class="form-control {{ $errors->has('prev_days_more') ? 'is-invalid' : '' }}" type="number" name="prev_days_more" id="prev_days_more" value="{{ old('prev_days_more', $courseCoupon->prev_days_more) }}" step="1">
                @if($errors->has('prev_days_more'))
                    <span class="text-danger">{{ $errors->first('prev_days_more') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.courseCoupon.fields.prev_days_more_helper') }}</span>
            </div>
            <div class="form-group">
                @include('partials.buttons.save')
                @include('partials.buttons.back', ['url'=>route('admin.course-coupons.index')])
            </div>
        </form>
    </div>
</div>



@endsection
