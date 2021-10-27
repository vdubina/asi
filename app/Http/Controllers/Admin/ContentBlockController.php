<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyContentBlockRequest;
use App\Http\Requests\StoreContentBlockRequest;
use App\Http\Requests\UpdateContentBlockRequest;
use App\Models\ContentBlock;
use App\Models\ContentPage;
use App\Models\TaxonomyContentBlockType;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ContentBlockController extends Controller
{
    use MediaUploadingTrait;

    public function index(TaxonomyContentBlockType $contentBlockType, Request $request)
    {
        abort_if(Gate::denies('content_block_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlocks = ContentBlock::with(['type', 'show_on_pages', 'media'])->get()->where('type_id', '=', $contentBlockType->id);

        return view('admin.contentBlocks.index', compact('contentBlocks', 'contentBlockType'));
    }

    public function create(TaxonomyContentBlockType $contentBlockType)
    {
        abort_if(Gate::denies('content_block_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlockTypes = TaxonomyContentBlockType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $show_on_pages = ContentPage::pluck('title', 'id');

        return view('admin.contentBlocks.create', compact('contentBlockTypes', 'show_on_pages', 'contentBlockType'));
    }

    public function store(TaxonomyContentBlockType $contentBlockType, StoreContentBlockRequest $request)
    {
        $contentBlock = ContentBlock::create($request->all());
        $contentBlock->show_on_pages()->sync($request->input('show_on_pages', []));
        if ($request->input('images', false)) {
            $contentBlock->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $contentBlock->id]);
        }

        return redirect()->route('admin.content-blocks.index', $contentBlockType->id);
    }

    public function edit(TaxonomyContentBlockType $contentBlockType, ContentBlock $contentBlock)
    {
        abort_if(Gate::denies('content_block_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlockTypes = TaxonomyContentBlockType::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $show_on_pages = ContentPage::pluck('title', 'id');

        $contentBlock->load('type', 'show_on_pages');

        return view('admin.contentBlocks.edit', compact('contentBlockTypes', 'show_on_pages', 'contentBlock', 'contentBlockType'));
    }

    public function update(TaxonomyContentBlockType $contentBlockType, UpdateContentBlockRequest $request, ContentBlock $contentBlock)
    {
        $contentBlock->update($request->all());
        $contentBlock->show_on_pages()->sync($request->input('show_on_pages', []));
        if ($request->input('images', false)) {
            if (!$contentBlock->images || $request->input('images') !== $contentBlock->images->file_name) {
                if ($contentBlock->images) {
                    $contentBlock->images->delete();
                }
                $contentBlock->addMedia(storage_path('tmp/uploads/' . basename($request->input('images'))))->toMediaCollection('images');
            }
        } elseif ($contentBlock->images) {
            $contentBlock->images->delete();
        }

        return redirect()->route('admin.content-blocks.index', $contentBlockType->id);
    }

    public function show(TaxonomyContentBlockType $contentBlockType, ContentBlock $contentBlock)
    {
        abort_if(Gate::denies('content_block_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlock->load('type', 'show_on_pages');

        return view('admin.contentBlocks.show', compact('contentBlock', 'contentBlockType'));
    }

    public function destroy(TaxonomyContentBlockType $contentBlockType, ContentBlock $contentBlock)
    {
        abort_if(Gate::denies('content_block_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contentBlock->delete();

        return back();
    }

    public function massDestroy(MassDestroyContentBlockRequest $request)
    {
        ContentBlock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('content_block_create') && Gate::denies('content_block_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ContentBlock();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
