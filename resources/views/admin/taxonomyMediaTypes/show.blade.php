@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyMediaType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-media-types.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyMediaType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaType->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-media-types.index')])
            </div>
        </div>
    </div>
</div>



@endsection
