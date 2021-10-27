@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyArmsCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-arms-categories.index')])
            </div>
            <table class="table table-striped compact">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyArmsCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyArmsCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCategory.fields.description') }}
                        </th>
                        <td>
                            {!! $taxonomyArmsCategory->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyArmsCategory.fields.field_offsiteid') }}
                        </th>
                        <td>
                            {{ $taxonomyArmsCategory->field_offsiteid }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                @include('partials.buttons.back', ['url'=>route('admin.taxonomy-arms-categories.index')])
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
            <a class="nav-link" href="#field_arms_category_taxonomy_arms_codes" role="tab" data-toggle="tab">
                {{ trans('cruds.taxonomyArmsCode.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="field_arms_category_taxonomy_arms_codes">
            @includeIf('admin.taxonomyArmsCategories.relationships.fieldArmsCategoryTaxonomyArmsCodes', ['taxonomyArmsCodes' => $taxonomyArmsCategory->fieldArmsCategoryTaxonomyArmsCodes])
        </div>
    </div>
</div>

@endsection
