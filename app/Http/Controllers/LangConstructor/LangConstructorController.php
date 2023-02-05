<?php

namespace App\Http\Controllers\LangConstructor;


use App\Http\Controllers\Controller;
use App\Models\Construction;
use App\Policies\Abilities;
use App\Services\Constructions\ConstructionsService;
use App\Services\ConstructionTypes\ConstructionTypesService;
use App\Http\Controllers\LangConstructor\Requests\SaveLangConstructorRequest;
use App\Jobs\Construction\ConstructionCreateProcess;
use App\Events\Construction\ConstructionCreateProcessEvent;

class LangConstructorController extends Controller
{
    protected $constructionsService;
    protected $constructionTypesService;

    public function __construct(
        ConstructionsService $constructionsService,
        ConstructionTypesService $constructionTypesService
    )
    {
        $this->constructionsService = $constructionsService;
        $this->constructionTypesService = $constructionTypesService;
    }

    public function index()
    {

        $this->authorize(Abilities::VIEW_ANY, Construction::class);

        return view('lang-constructor.lang-constructor.index',
            [
                'langConstructor' => $this->constructionsService->getAllConstruction()
            ]
        );
    }

    public function edit($id = null)
    {
        $this->authorize(Abilities::UPDATE, Construction::class);

        $parameters = [
            'langConstructor' => $this->constructionsService->findOrNew($id),
            'langConstructorTypes' => $this->constructionTypesService->getListTypes()
        ];

        return view('lang-constructor.lang-constructor.edit', $parameters);
    }

    public function save(SaveLangConstructorRequest $request, $id = null)
    {


        $this->authorize(Abilities::UPDATE, Construction::class);
        $data = $request->getFormData();


        ConstructionCreateProcess::dispatch([
            'id' => $id,
            'data' => $data
        ]);

        \Event::dispatch(new ConstructionCreateProcessEvent($id, $data));

        return redirect(route('lang-constructor-index'))->with('status', __('system.saved'));

    }

    public function delete($id)
    {
        $this->authorize(Abilities::DELETE, Construction::class);
        $this->constructionsService->delete($id);

        return redirect(route('lang-constructor-index'))->with('status', __('system.deleted'));
    }
}
