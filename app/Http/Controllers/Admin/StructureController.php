<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStructureRequest;
use App\Http\Requests\StoreStructureRequest;
use App\Http\Requests\UpdateStructureRequest;
use App\Models\ContentPage;
use App\Models\Structure;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StructureController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('structure_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $structures = Structure::with(['page'])->get();

        return view('admin.structures.index', compact('structures'));
    }

    public function create()
    {
        abort_if(Gate::denies('structure_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = ContentPage::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.structures.create', compact('pages'));
    }

    public function store(StoreStructureRequest $request)
    {
        $structure = Structure::create($request->all());

        return redirect()->route('admin.structures.index');
    }

    public function edit(Structure $structure)
    {
        abort_if(Gate::denies('structure_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pages = ContentPage::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $structure->load('page');

        return view('admin.structures.edit', compact('pages', 'structure'));
    }

    public function update(UpdateStructureRequest $request, Structure $structure)
    {
        $structure->update($request->all());

        return redirect()->route('admin.structures.index');
    }

    public function show(Structure $structure)
    {
        abort_if(Gate::denies('structure_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $structure->load('page');

        return view('admin.structures.show', compact('structure'));
    }

    public function destroy(Structure $structure)
    {
        abort_if(Gate::denies('structure_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $structure->delete();

        return back();
    }

    public function massDestroy(MassDestroyStructureRequest $request)
    {
        Structure::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
