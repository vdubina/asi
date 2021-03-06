@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyDiscountType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-discount-types.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyDiscountType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyDiscountType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyDiscountType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyDiscountType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyDiscountType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyDiscountType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyDiscountType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyDiscountType->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyDiscountType.fields.field_amount') }}
                        </th>
                        <td>
                            {{ $taxonomyDiscountType->field_amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-discount-types.index')])
            </div>
        </div>
    </div>
</div>



@endsection
