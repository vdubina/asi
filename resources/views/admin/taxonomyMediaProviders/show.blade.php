@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyMediaProvider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-media-providers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaProvider.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaProvider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaProvider.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaProvider->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaProvider.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyMediaProvider->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyMediaProvider.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyMediaProvider->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-media-providers.index') }}">
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
            <a class="nav-link" href="#field_media_provider_course_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.courseTopic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#field_media_provider_course_products" role="tab" data-toggle="tab">
                {{ trans('cruds.courseProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_media_provider_course_topics">
            @includeIf('admin.taxonomyMediaProviders.relationships.fieldMediaProviderCourseTopics', ['courseTopics' => $taxonomyMediaProvider->fieldMediaProviderCourseTopics])
        </div>
        <div class="tab-pane" role="tabpanel" id="field_media_provider_course_products">
            @includeIf('admin.taxonomyMediaProviders.relationships.fieldMediaProviderCourseProducts', ['courseProducts' => $taxonomyMediaProvider->fieldMediaProviderCourseProducts])
        </div>
    </div>
</div>

@endsection