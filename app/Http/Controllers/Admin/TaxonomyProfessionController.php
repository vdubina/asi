<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyTaxonomyProfessionRequest;
use App\Http\Requests\StoreTaxonomyProfessionRequest;
use App\Http\Requests\UpdateTaxonomyProfessionRequest;
use App\Models\TaxonomyProfession;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyProfessionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('taxonomy_profession_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyProfessions = TaxonomyProfession::all();

        return view('admin.taxonomyProfessions.index', compact('taxonomyProfessions'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_profession_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyProfessions.create');
    }

    public function store(StoreTaxonomyProfessionRequest $request)
    {
        $taxonomyProfession = TaxonomyProfession::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $taxonomyProfession->id]);
        }

        return redirect()->route('admin.taxonomy-professions.index');
    }

    public function edit(TaxonomyProfession $taxonomyProfession)
    {
        abort_if(Gate::denies('taxonomy_profession_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyProfessions.edit', compact('taxonomyProfession'));
    }

    public function update(UpdateTaxonomyProfessionRequest $request, TaxonomyProfession $taxonomyProfession)
    {
        $taxonomyProfession->update($request->all());

        return redirect()->route('admin.taxonomy-professions.index');
    }

    public function show(TaxonomyProfession $taxonomyProfession)
    {
        abort_if(Gate::denies('taxonomy_profession_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyProfessions.show', compact('taxonomyProfession'));
    }

    public function destroy(TaxonomyProfession $taxonomyProfession)
    {
        abort_if(Gate::denies('taxonomy_profession_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyProfession->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyProfessionRequest $request)
    {
        TaxonomyProfession::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('taxonomy_profession_create') && Gate::denies('taxonomy_profession_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new TaxonomyProfession();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
