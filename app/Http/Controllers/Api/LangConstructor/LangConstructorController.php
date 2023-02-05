<?php

namespace App\Http\Controllers\Api\LangConstructor;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\LangConstructor\Requests\SaveLangConstructorRequest;
use App\Services\Constructions\ConstructionsService;
use App\Http\Controllers\Api\LangConstructor\Resources\ConstructionResource;
use App\Http\Controllers\Api\LangConstructor\Resources\ConstructionsResource;
use App\Models\Construction;


class LangConstructorController extends Controller
{
    protected $constructionsService;


    public function __construct(
        ConstructionsService $constructionsService
    )
    {
        $this->constructionsService = $constructionsService;

    }

    /**
     * @SWG\Get(
     *     path="/constructions/",
     *     summary="Get Constructions all",
     *     tags={"Constructions"},
     *     description="Get Constructions by id",
     *
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="This is my website cool API",
     *         description="Api description...",
     *         termsOfService="",
     *         @SWG\Contact(
     *             email="contact@mysite.com"
     *         ),
     *         @SWG\License(
     *             name="Private License",
     *             url="URL to the license"
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Post is not found",
     *     )
     * )
     */

    public function index()
    {

        $constructions = $this->constructionsService->getAllConstructionCached();
        return response()->json(new ConstructionsResource($constructions));
    }

    /**
     * @SWG\Put(
     *     path="/constructions/{id}",
     *     summary="Get Constructions by id",
     *     tags={"Constructions"},
     *     description="Put Constructions by id",
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="This is my website cool API",
     *         description="Api description...",
     *         termsOfService="",
     *         @SWG\Contact(
     *             email="contact@mysite.com"
     *         ),
     *         @SWG\License(
     *             name="Private License",
     *             url="URL to the license"
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Post is not found",
     *     )
     * )
     *
     */

    public function store(SaveLangConstructorRequest $request)
    {

        $data = $request->getFormData();
        $construction = $this->constructionsService->createConstruction($data);

        return response()->json(new ConstructionResource($construction));
    }


    /**
     * @SWG\Get(
     *     path="/constructions/{id}",
     *     summary="Get Constructions by id",
     *     tags={"Constructions"},
     *     description="Get Constructions by id",
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="This is my website cool API",
     *         description="Api description...",
     *         termsOfService="",
     *         @SWG\Contact(
     *             email="contact@mysite.com"
     *         ),
     *         @SWG\License(
     *             name="Private License",
     *             url="URL to the license"
     *         )
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="Unauthorized user",
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Post is not found",
     *     )
     * )
     *
     */


    public function show(Construction $constructions)
    {
        return response()->json(new ConstructionResource($constructions));
    }


    public function update(SaveLangConstructorRequest $request, Construction $constructions)
    {
        $data = $request->getFormData();


        $construction = $this->constructionsService->createOrUpdateConstruction($constructions, $data);

        return response()->json(new ConstructionResource($construction));
    }


    public function destroy(Construction $constructions)
    {
        $constructions->delete();
    }


}
