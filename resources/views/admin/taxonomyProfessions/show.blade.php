@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyProfession.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-professions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyProfession->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyProfession->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyProfession->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyProfession->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.field_salutation') }}
                        </th>
                        <td>
                            {{ $taxonomyProfession->field_salutation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.field_allied_professional') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyProfession->field_allied_professional ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyProfession.fields.field_ad_customer_category') }}
                        </th>
                        <td>
                            {{ $taxonomyProfession->field_ad_customer_category }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-professions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection