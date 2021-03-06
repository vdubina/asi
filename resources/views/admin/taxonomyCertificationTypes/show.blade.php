@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyCertificationType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-certification-types.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCertificationType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyCertificationType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCertificationType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyCertificationType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCertificationType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyCertificationType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyCertificationType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyCertificationType->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-certification-types.index')])
            </div>
        </div>
    </div>
</div>



@endsection
