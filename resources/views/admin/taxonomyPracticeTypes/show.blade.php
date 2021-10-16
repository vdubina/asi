@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyPracticeType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-practice-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPracticeType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyPracticeType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPracticeType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyPracticeType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPracticeType.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyPracticeType->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyPracticeType.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyPracticeType->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-practice-types.index') }}">
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
            <a class="nav-link" href="#field_practice_type_taxonomy_web_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.taxonomyWebCategory.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#field_practice_type_course_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.courseTopic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#field_practice_type_course_products" role="tab" data-toggle="tab">
                {{ trans('cruds.courseProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_practice_type_taxonomy_web_categories">
            @includeIf('admin.taxonomyPracticeTypes.relationships.fieldPracticeTypeTaxonomyWebCategories', ['taxonomyWebCategories' => $taxonomyPracticeType->fieldPracticeTypeTaxonomyWebCategories])
        </div>
        <div class="tab-pane" role="tabpanel" id="field_practice_type_course_topics">
            @includeIf('admin.taxonomyPracticeTypes.relationships.fieldPracticeTypeCourseTopics', ['courseTopics' => $taxonomyPracticeType->fieldPracticeTypeCourseTopics])
        </div>
        <div class="tab-pane" role="tabpanel" id="field_practice_type_course_products">
            @includeIf('admin.taxonomyPracticeTypes.relationships.fieldPracticeTypeCourseProducts', ['courseProducts' => $taxonomyPracticeType->fieldPracticeTypeCourseProducts])
        </div>
    </div>
</div>

@endsection
