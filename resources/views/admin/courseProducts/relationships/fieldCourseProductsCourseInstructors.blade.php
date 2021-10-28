<div class="m-3">
    @can('course_instructor_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.course-instructors.create')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.courseInstructor.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" {{ config('panel.datatables.css') }} datatable-CourseInstructor">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.courseInstructor.fields.name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courseInstructors as $key => $courseInstructor)
                            <tr data-entry-id="{{ $courseInstructor->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $courseInstructor->name ?? '' }}
                                </td>
                                <td>
                                    @can('course_instructor_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.course-instructors.show', $courseInstructor->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('course_instructor_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.course-instructors.edit', $courseInstructor->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('course_instructor_delete')
                                        <form action="{{ route('admin.course-instructors.destroy', $courseInstructor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
    @parent
    @include('partials.scripts.dataTableButtons', [
     'route'=>'course-instructors',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
