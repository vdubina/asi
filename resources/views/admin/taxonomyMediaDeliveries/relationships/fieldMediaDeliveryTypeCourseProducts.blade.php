<div class="m-3">
    @can('course_product_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.taxonomy-course-products.create')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.courseProduct.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" {{ config('panel.datatables.css') }} datatable-CourseProduct">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.title') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.sku') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.commerce_price') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.courseProduct.fields.field_offsiteid') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courseProducts as $key => $courseProduct)
                            <tr data-entry-id="{{ $courseProduct->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $courseProduct->title ?? '' }}
                                </td>
                                <td>
                                    {{ $courseProduct->sku ?? '' }}
                                </td>
                                <td>
                                    {{ $courseProduct->commerce_price ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $courseProduct->status ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $courseProduct->status ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $courseProduct->field_offsiteid ?? '' }}
                                </td>
                                <td>
                                    @can('course_product_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.course-products.show', $courseProduct->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('course_product_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.course-products.edit', $courseProduct->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('course_product_delete')
                                        <form action="{{ route('admin.course-products.destroy', $courseProduct->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'course-products',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
