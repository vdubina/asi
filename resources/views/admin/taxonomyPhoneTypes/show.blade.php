@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyPhoneType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-phone-types.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPhoneType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyPhoneType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPhoneType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyPhoneType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPhoneType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyPhoneType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPhoneType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyPhoneType->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-phone-types.index')])
            </div>
        </div>
    </div>
</div>



@endsection
