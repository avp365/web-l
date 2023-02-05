<?php


namespace App\Services\Constructions;

use App\Models\Construction;
use App\Services\Constructions\Handlers\CreateConstructionHandler;
use App\Services\Constructions\Handlers\UpdateConstructionHandler;
use App\Services\Constructions\Handlers\DeleteConstructionHandler;
use App\Services\Constructions\Repositories\ConstructionRepositoryInterface;
use App\Services\Constructions\Repositories\CachedConstructionRepositoryInterface;


class ConstructionsService
{

    private $createConstructionHandler;
    private $updateConstructionHandler;
    private $deleteConstructionHandler;
    private $constructionRepository;
    private $cachedConstructionRepository;

    public function __construct(
        CreateConstructionHandler $createConstructionHandler,
        UpdateConstructionHandler $updateConstructionHandler,
        DeleteConstructionHandler $deleteConstructionHandler,
        ConstructionRepositoryInterface $constructionRepository,
        CachedConstructionRepositoryInterface $cachedConstructionRepository
    )
    {
        $this->createConstructionHandler = $createConstructionHandler;
        $this->updateConstructionHandler = $updateConstructionHandler;
        $this->deleteConstructionHandler = $deleteConstructionHandler;
        $this->constructionRepository = $constructionRepository;
        $this->cachedConstructionRepository = $cachedConstructionRepository;
    }

    /**
     * @param array $data
     * @return Construction
     */
    public function createConstruction(array $data): Construction
    {
        return $this->createConstructionHandler->handle($data);
    }


    /**
     * @param $construction
     * @param array $data
     * @return Construction
     */
    public function createOrUpdateConstruction($construction, array $data): Construction
    {
        if ($construction) {
            return $this->updateConstructionHandler->handle($construction, $data);
        }

        return $this->createConstruction($data);
    }


    public function getAllConstruction()
    {
        return $this->constructionRepository->getAllConstruction();
    }

    public function getAllConstructionCached()
    {
        return $this->cachedConstructionRepository->getAllConstruction();
    }

    public function clearConstructionCache()
    {
        return $this->cachedConstructionRepository->clearConstructionCache();
    }

    public function find($id = null)
    {
        /** @var Construction $langConstructor */

        if ($id && !is_null($langConstructor = $this->constructionRepository->find($id))) {
            return $langConstructor;
        }

        return null;
    }

    public function findOrNew($id = null): Construction
    {
        /** @var Construction $langConstructor */

        if ($id && !is_null($langConstructor = $this->constructionRepository->find($id))) {
            return $langConstructor;
        }

        return $this->constructionRepository->new();
    }

    public function delete($id): int
    {
        return $this->deleteConstructionHandler->handle($id);

    }

}
