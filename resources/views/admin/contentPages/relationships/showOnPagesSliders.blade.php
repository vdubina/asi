<div class="m-3">
    @can('slider_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.sliders.create')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.slider.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" {{ config('panel.datatables.css') }} datatable-showOnPagesSliders">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.slider.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.slider.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.slider.fields.field_is_subsite_content') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $key => $slider)
                            <tr data-entry-id="{{ $slider->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $slider->id ?? '' }}
                                </td>
                                <td>
                                    {{ $slider->name ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $slider->field_is_subsite_content ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $slider->field_is_subsite_content ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @can('slider_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.sliders.show', $slider->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('slider_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.sliders.edit', $slider->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('slider_delete')
                                        <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    @include('partials.scripts.dataTableButtons', [
     'route'=>'sliders',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
