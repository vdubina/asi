<div class="m-3">
    @can('taxonomy_arms_code_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                @include('partials.buttons.add', ['url'=>route('admin.taxonomy-arms-codes.create')])
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.taxonomyArmsCode.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" {{ config('panel.datatables.css') }} datatable-TaxonomyArmsCode">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.taxonomyArmsCode.fields.name') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($taxonomyArmsCodes as $key => $taxonomyArmsCode)
                            <tr data-entry-id="{{ $taxonomyArmsCode->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $taxonomyArmsCode->name ?? '' }}
                                </td>
                                <td>
                                    @can('taxonomy_arms_code_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.taxonomy-arms-codes.show', $taxonomyArmsCode->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('taxonomy_arms_code_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.taxonomy-arms-codes.edit', $taxonomyArmsCode->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('taxonomy_arms_code_delete')
                                        <form action="{{ route('admin.taxonomy-arms-codes.destroy', $taxonomyArmsCode->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
     'route'=>'taxonomy-arms-codes',
     'order'=>'[[ 1, "asc" ]]',
     'pageLength'=>10
    ])
@endsection
