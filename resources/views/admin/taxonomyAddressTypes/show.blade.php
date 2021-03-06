@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyAddressType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-address-types.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAddressType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyAddressType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAddressType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyAddressType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAddressType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyAddressType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAddressType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyAddressType->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-address-types.index')])
            </div>
        </div>
    </div>
</div>



@endsection
