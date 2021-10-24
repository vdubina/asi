@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{$contentBlockType->name}} {{ trans('global.item') }} {{ trans('global.show') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-blocks.index',$contentBlockType->id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.id') }}
                        </th>
                        <td>
                            {{ $contentBlock->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.title') }}
                        </th>
                        <td>
                            {{ $contentBlock->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.content') }}
                        </th>
                        <td>
                            {!! $contentBlock->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.images') }}
                        </th>
                        <td>
                            @if($contentBlock->images)
                                <a href="{{ $contentBlock->images->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $contentBlock->images->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.type') }}
                        </th>
                        <td>
                            {{ $contentBlock->type->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.contentBlock.fields.show_on_pages') }}
                        </th>
                        <td>
                            @foreach($contentBlock->show_on_pages as $key => $show_on_pages)
                                <span class="label label-info">{{ $show_on_pages->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.content-blocks.index',$contentBlockType->id) }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
