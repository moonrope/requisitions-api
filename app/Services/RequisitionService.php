<?php

namespace App\Services;

use App\Repositories\RequisitionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RequisitionService
{
    public function __construct(
        private RequisitionRepository $requisitionRepository
    ){
    }

    public function index(): Collection|array
    {
        return $this->requisitionRepository->getAll();
    }

    public function getById(int $id): Model
    {
        return $this->requisitionRepository->getById($id);
    }

    public function store(array $values): Model
    {
        return $this->requisitionRepository->create($values);
    }

    public function update(int $id, array $values): Model
    {
        $this->requisitionRepository->update($id, $values);
        return $this->getById($id);
    }

    public function delete(int $id): int
    {
        return $this->requisitionRepository->delete($id);
    }
}
