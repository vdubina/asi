<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTaxonomyContentBlockTypeRequest;
use App\Http\Requests\StoreTaxonomyContentBlockTypeRequest;
use App\Http\Requests\UpdateTaxonomyContentBlockTypeRequest;
use App\Models\TaxonomyContentBlockType;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaxonomyContentBlockTypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('taxonomy_content_block_type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyContentBlockTypes = TaxonomyContentBlockType::all();

        return view('admin.taxonomyContentBlockTypes.index', compact('taxonomyContentBlockTypes'));
    }

    public function create()
    {
        abort_if(Gate::denies('taxonomy_content_block_type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyContentBlockTypes.create');
    }

    public function store(StoreTaxonomyContentBlockTypeRequest $request)
    {
        $taxonomyContentBlockType = TaxonomyContentBlockType::create($request->all());

        return redirect()->route('admin.taxonomy-content-block-types.index');
    }

    public function edit(TaxonomyContentBlockType $taxonomyContentBlockType)
    {
        abort_if(Gate::denies('taxonomy_content_block_type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.taxonomyContentBlockTypes.edit', compact('taxonomyContentBlockType'));
    }

    public function update(UpdateTaxonomyContentBlockTypeRequest $request, TaxonomyContentBlockType $taxonomyContentBlockType)
    {
        $taxonomyContentBlockType->update($request->all());

        return redirect()->route('admin.taxonomy-content-block-types.index');
    }

    public function show(TaxonomyContentBlockType $taxonomyContentBlockType)
    {
        abort_if(Gate::denies('taxonomy_content_block_type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyContentBlockType->load('typeContentBlocks');

        return view('admin.taxonomyContentBlockTypes.show', compact('taxonomyContentBlockType'));
    }

    public function destroy(TaxonomyContentBlockType $taxonomyContentBlockType)
    {
        abort_if(Gate::denies('taxonomy_content_block_type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxonomyContentBlockType->delete();

        return back();
    }

    public function massDestroy(MassDestroyTaxonomyContentBlockTypeRequest $request)
    {
        TaxonomyContentBlockType::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
