@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.taxonomyContentBlockType.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-content-block-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyContentBlockType.fields.id') }}
                        </th>
                        <td>
                            {{ $taxonomyContentBlockType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyContentBlockType.fields.name') }}
                        </th>
                        <td>
                            {{ $taxonomyContentBlockType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.taxonomyContentBlockType.fields.fa_icon') }}
                        </th>
                        <td>
                            {{ $taxonomyContentBlockType->fa_icon }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.taxonomy-content-block-types.index') }}">
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
            <a class="nav-link" href="#type_content_blocks" role="tab" data-toggle="tab">
                {{ trans('cruds.contentBlock.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="type_content_blocks">
            @includeIf('admin.taxonomyContentBlockTypes.relationships.typeContentBlocks', ['contentBlocks' => $taxonomyContentBlockType->typeContentBlocks])
        </div>
    </div>
</div>

@endsection