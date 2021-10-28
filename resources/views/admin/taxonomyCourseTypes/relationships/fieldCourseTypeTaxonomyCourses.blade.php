<div class="m-3">
    @can('taxonomy_course_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.taxonomy-courses.create')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.taxonomyCourse.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyCourse">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.taxonomyCourse.fields.name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taxonomyCourses as $key => $taxonomyCourse)
                            <tr data-entry-id="{{ $taxonomyCourse->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $taxonomyCourse->name ?? '' }}
                                </td>
                                <td>
                                    @can('taxonomy_course_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-courses.show', $taxonomyCourse->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('taxonomy_course_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-courses.edit', $taxonomyCourse->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('taxonomy_course_delete')
                                        <form action="{{ route('admin.taxonomy-courses.destroy', $taxonomyCourse->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-courses',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
