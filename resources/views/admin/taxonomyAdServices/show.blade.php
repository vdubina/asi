@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyAdService.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-ad-services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAdService.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyAdService->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAdService.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyAdService->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAdService.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyAdService->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAdService.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyAdService->field_offsiteid }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAdService.fields.field_ad_service_code') }}
                        </th>
                        <td>
                            {{ $taxonomyAdService->field_ad_service_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyAdService.fields.field_audio_digest_subscription') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $taxonomyAdService->field_audio_digest_subscription ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-ad-services.index') }}">
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
            <a class="nav-link" href="#field_ad_service_course_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.courseTopic.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_ad_service_course_topics">
            @includeIf('admin.taxonomyAdServices.relationships.fieldAdServiceCourseTopics', ['courseTopics' => $taxonomyAdService->fieldAdServiceCourseTopics])
        </div>
    </div>
</div>

@endsection
