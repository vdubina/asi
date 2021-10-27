@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyContentBlockType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-content-block-types.index')])
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyContentBlockType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyContentBlockType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyContentBlockType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyContentBlockType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyContentBlockType.fields.fa_icon') }}
                        </th>
                        <td>
                            {{ $taxonomyContentBlockType->fa_icon }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-content-block-types.index')])
            </div>
        </div>
    </div>
</div>
@endsection
