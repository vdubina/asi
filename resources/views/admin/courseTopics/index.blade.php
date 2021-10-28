@extends('layouts.admin')
@section('content')
@can('course_topic_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            @include('partials.buttons.add', ['url'=>route('admin.course-topics.create')])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.courseTopic.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" {{ config('panel.datatables.css') }} datatable-CourseTopic">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.courseTopic.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_offsiteid') }}
                        </th>
                        <th>
                            {{ trans('cruds.courseTopic.fields.field_price') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courseTopics as $key => $courseTopic)
                        <tr data-entry-id="{{ $courseTopic->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $courseTopic->title ?? '' }}
                            </td>
                            <td>
                                {{ $courseTopic->field_offsiteid ?? '' }}
                            </td>
                            <td>
                                {{ $courseTopic->field_price ?? '' }}
                            </td>
                            <td>
                                @can('course_topic_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.course-topics.show', $courseTopic->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('course_topic_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.course-topics.edit', $courseTopic->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('course_topic_delete')
                                    <form action="{{ route('admin.course-topics.destroy', $courseTopic->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('partials.scripts.dataTableButtons', [
     'route'=>'course-topics',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
