@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyWebCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-web-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyWebCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyWebCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyWebCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyWebCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyWebCategory.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyWebCategory->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyWebCategory.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyWebCategory->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyWebCategory.fields.field_practice_type') }}
                        </th>
                        <td>
                            {{ $taxonomyWebCategory->field_practice_type->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-web-categories.index') }}">
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
            <a class="nav-link" href="#field_web_category_course_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.courseTopic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#field_web_category_course_products" role="tab" data-toggle="tab">
                {{ trans('cruds.courseProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_web_category_course_topics">
            @includeIf('admin.taxonomyWebCategories.relationships.fieldWebCategoryCourseTopics', ['courseTopics' => $taxonomyWebCategory->fieldWebCategoryCourseTopics])
        </div>
        <div class="tab-pane" role="tabpanel" id="field_web_category_course_products">
            @includeIf('admin.taxonomyWebCategories.relationships.fieldWebCategoryCourseProducts', ['courseProducts' => $taxonomyWebCategory->fieldWebCategoryCourseProducts])
        </div>
    </div>
</div>

@endsection
