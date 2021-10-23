<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaxonomyTagRequest;
use App\Http\Requests\StoreTaxonomyTagRequest;
use App\Http\Requests\UpdateTaxonomyTagRequest;
use App\Models\TaxonomyTag;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyTagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('taxonomy_tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyTags = TaxonomyTag::all();

        return view('admin.taxonomyTags.index', compact('taxonomyTags'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyTags.create');
    }

    public function store(StoreTaxonomyTagRequest $request)
    {
        $taxonomyTag = TaxonomyTag::create($request->all());

        return redirect()->route('admin.taxonomy-tags.index');
    }

    public function edit(TaxonomyTag $taxonomyTag)
    {
        abort_if(Gate::denies('taxonomy_tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyTags.edit', compact('taxonomyTag'));
    }

    public function update(UpdateTaxonomyTagRequest $request, TaxonomyTag $taxonomyTag)
    {
        $taxonomyTag->update($request->all());

        return redirect()->route('admin.taxonomy-tags.index');
    }

    public function show(TaxonomyTag $taxonomyTag)
    {
        abort_if(Gate::denies('taxonomy_tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyTags.show', compact('taxonomyTag'));
    }

    public function destroy(TaxonomyTag $taxonomyTag)
    {
        abort_if(Gate::denies('taxonomy_tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyTag->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyTagRequest $request)
    {
        TaxonomyTag::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
