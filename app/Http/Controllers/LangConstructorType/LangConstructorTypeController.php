<?php

namespace App\Http\Controllers\LangConstructorType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LangConstructorType\Requests\SaveLangConstructorTypeRequest;
use App\Models\Construction;
use App\Models\ConstructionType;
use App\Services\ConstructionTypes\ConstructionTypesService;
use App\Policies\Abilities;

class LangConstructorTypeController extends Controller
{
    protected $constructionTypesService;

    public function __construct(
        ConstructionTypesService $constructionTypesService
    )
    {
        $this->constructionTypesService = $constructionTypesService;
    }
    public function index()
    {

        return view('lang-constructor.lang-constructor-type.index',['langConstructorTypes' => $this->constructionTypesService->getAllConstructionTypes()]);
    }

    public function edit($id = null)
    {
        $this->authorize(Abilities::UPDATE, Construction::class);
        return view('lang-constructor.lang-constructor-type.edit',['langConstructorType' => $this->constructionTypesService->findOrNew($id)]);
    }

    public function save(SaveLangConstructorTypeRequest $request,$id = null)
    {

        $this->authorize(Abilities::UPDATE, ConstructionType::class);
        $data  =  $request->getFormData();

        $constructionType = $this->constructionTypesService->find($id);

        $this->constructionTypesService->createOrUpdateConstructionType($constructionType,$data);

        return redirect(route('lang-constructor-type-index'))->with('status',__('system.saved'));

    }

    public function delete($id)
    {
        $this->constructionTypesService->delete($id);

        return redirect(route('lang-constructor-type-index'))->with('status',__('system.deleted'));
    }
}
