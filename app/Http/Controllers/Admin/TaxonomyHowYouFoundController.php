<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyHowYouFoundRequest;
use App\Http\Requests\StoreTaxonomyHowYouFoundRequest;
use App\Http\Requests\UpdateTaxonomyHowYouFoundRequest;
use App\Models\TaxonomyHowYouFound;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyHowYouFoundController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_how_you_found_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyHowYouFounds = TaxonomyHowYouFound::all();

        return view('admin.taxonomyHowYouFounds.index', compact('taxonomyHowYouFounds'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_how_you_found_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyHowYouFounds.create');
    }

    public function store(StoreTaxonomyHowYouFoundRequest $request)
    {
        $taxonomyHowYouFound = TaxonomyHowYouFound::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyHowYouFound->id]);
        }

        return redirect()->route('admin.taxonomy-how-you-founds.index');
    }

    public function edit(TaxonomyHowYouFound $taxonomyHowYouFound)
    {
        abort_if(Gate::denies('taxonomy_how_you_found_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyHowYouFounds.edit', compact('taxonomyHowYouFound'));
    }

    public function update(UpdateTaxonomyHowYouFoundRequest $request, TaxonomyHowYouFound $taxonomyHowYouFound)
    {
        $taxonomyHowYouFound->update($request->all());

        return redirect()->route('admin.taxonomy-how-you-founds.index');
    }

    public function show(TaxonomyHowYouFound $taxonomyHowYouFound)
    {
        abort_if(Gate::denies('taxonomy_how_you_found_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyHowYouFounds.show', compact('taxonomyHowYouFound'));
    }

    public function destroy(TaxonomyHowYouFound $taxonomyHowYouFound)
    {
        abort_if(Gate::denies('taxonomy_how_you_found_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyHowYouFound->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyHowYouFoundRequest $request)
    {
        TaxonomyHowYouFound::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_how_you_found_create') && Gate::denies('taxonomy_how_you_found_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyHowYouFound();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
