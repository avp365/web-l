<?php


namespace App\Services\ConstructionTypes\Handlers;

use App\Models\ConstructionType;
use App\Services\ConstructionTypes\Repositories\ConstructionTypesRepositoryInterface;

/**
 * Class UpdateConstructionTypeHandler
 * @package App\Services\ConstructionTypes\Handlers
 */
class UpdateConstructionTypeHandler
{
    /**
     * @var ConstructionTypesRepositoryInterface
     */
    private $constructionTypesRepository;

    public function __construct(
        ConstructionTypesRepositoryInterface $constructionTypesRepository
    )
    {
        $this->constructionTypesRepository = $constructionTypesRepository;
    }

    public function handle(ConstructionType $constructionType ,array $data): ConstructionType
    {
        return $this->constructionTypesRepository->updateFromArray($constructionType,$data);
    }
}
