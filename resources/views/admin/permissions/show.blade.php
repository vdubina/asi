@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.permission.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.permissions.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.permission.fields.id') }}
                        </th>
                        <td>
                            {{ $permission->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.permission.fields.title') }}
                        </th>
                        <td>
                            {{ $permission->title }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.permissions.index')])
            </div>
        </div>
    </div>
</div>



@endsection
