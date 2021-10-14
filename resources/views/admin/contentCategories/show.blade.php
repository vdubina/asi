@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.contentCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $contentCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $contentCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentCategory.fields.slug') }}
                        </th>
                        <td>
                            {{ $contentCategory->slug }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#show_on_pages_sliders" role="tab" data-toggle="tab">
                {{ trans('cruds.slider.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="show_on_pages_sliders">
            @includeIf('admin.contentCategories.relationships.showOnPagesSliders', ['sliders' => $contentCategory->showOnPagesSliders])
        </div>
    </div>
</div>

@endsection
