<?php


namespace App\Services\Constructions\Handlers;

use App\Models\Construction;

use App\Services\Constructions\Repositories\ConstructionRepositoryInterface;

class UpdateConstructionHandler
{
    private $constructionRepository;

    public function __construct(
        ConstructionRepositoryInterface $constructionRepository
    )
    {
        $this->constructionRepository = $constructionRepository;
    }


    /**
     * @param Construction $construction
     * @param array $data
     * @return Construction
     */
    public function handle(Construction $construction, array $data): Construction
    {
        return $this->constructionRepository->updateFromArray($construction, $data);
    }
}
