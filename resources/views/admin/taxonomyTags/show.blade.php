@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyTag.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-tags.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTag.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyTag->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTag.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyTag->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyTag.fields.slug') }}
                        </th>
                        <td>
                            {{ $taxonomyTag->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-tags.index')])
            </div>
        </div>
    </div>
</div>



@endsection
