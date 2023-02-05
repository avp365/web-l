<?php


namespace App\Services\ConstructionTypes;

use App\Models\ConstructionType;
use App\Services\ConstructionTypes\Handlers\CreateConstructionTypeHandler;
use App\Services\ConstructionTypes\Handlers\UpdateConstructionTypeHandler;
use App\Services\ConstructionTypes\Handlers\DeleteConstructionTypeHandler;
use App\Services\ConstructionTypes\Repositories\ConstructionTypesRepositoryInterface;
use Illuminate\Support\Collection;

/**
 * Class ConstructionTypesService
 * @package App\Services\ConstructionTypes
 */
class ConstructionTypesService
{

    /**
     * @var CreateConstructionTypeHandler
     */
    private $createConstructionTypeHandler;
    private $updateConstructionTypeHandler;
    private $deleteConstructionTypeHandler;
    private $constructionTypeRepository;

    public function __construct(
        CreateConstructionTypeHandler $createConstructionTypeHandler,
        UpdateConstructionTypeHandler $updateConstructionTypeHandler,
        DeleteConstructionTypeHandler $deleteConstructionTypeHandler,
        ConstructionTypesRepositoryInterface $constructionTypeRepository
    )
    {
        $this->createConstructionTypeHandler = $createConstructionTypeHandler;
        $this->updateConstructionTypeHandler = $updateConstructionTypeHandler;
        $this->deleteConstructionTypeHandler = $deleteConstructionTypeHandler;
        $this->constructionTypeRepository = $constructionTypeRepository;
    }

    /**
     * @param array $data
     * @return ConstructionType
     */
    public function createConstructionType(array $data): ConstructionType
    {
        return $this->createConstructionTypeHandler->handle($data);
    }


    /**
     * @param ConstructionType $constructionType
     * @param array $data
     * @return ConstructionType+
     */
    public function createOrUpdateConstructionType($constructionType, array $data): ConstructionType
    {
        if ($constructionType) {
            return $this->updateConstructionTypeHandler->handle($constructionType, $data);
        }

        return $this->createConstructionType($data);

    }

    public function getAllConstructionTypes()
    {
        return $this->constructionTypeRepository->getAllConstructionTypes();
    }

    public function getListTypes()
    {
        /** @var ConstructionType $constructorTypes */
        $constructorTypes = $this->constructionTypeRepository->getAllConstructionTypes();

        if ($constructorTypes) {
            return $constructorTypes->mapWithKeys(function ($item) {
                return [$item->code => $item->name];
            });
        }

        return new Collection();

    }

    public function find($id = null)
    {
        /** @var ConstructionType $langConstructor */
        if ($id && !is_null($langConstructor = $this->constructionTypeRepository->find($id))) {
            return $langConstructor;
        }

        return null;
    }

    public function findOrNew($id = null): ConstructionType
    {
        /** @var ConstructionType $langConstructor */
        if ($id && !is_null($langConstructor = $this->constructionTypeRepository->find($id))) {
            return $langConstructor;
        }

        return $this->constructionTypeRepository->new();
    }

    public function delete($id): int
    {
        return $this->deleteConstructionTypeHandler->handle($id);

    }

}
