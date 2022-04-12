<?php

namespace App\Services;

use App\Repositories\RequisitionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RequisitionService
{
    public function __construct(
        private RequisitionRepository $requisitionRepository,
        private ItemService $itemService
    ){
    }

    public function index(): Collection|array
    {
        return $this->requisitionRepository->getAll();
    }

    public function getById(int $id): Model
    {
        return $this->requisitionRepository->getById($id)->load('items');
    }

    public function store(array $values): Model
    {
        $items = $values['items'] ?? null;

        if(!$items){
            return $this->requisitionRepository->store($values);
        }

        $requisition = $this->requisitionRepository->store(
            [
                'name' => $values['name'],
                'description' => $values['description'],
            ]
        );

        foreach ($items as $item){
            $this->itemService->store(
                [
                    'name' => $item['name'],
                    'requisition_id' => $requisition->id
                ]
            );

        }

        return $requisition->load('items');
    }

    public function update(int $id, array $values): Model
    {
        $this->requisitionRepository->update($id, $values);
        return $this->getById($id)->load('items');
    }

    public function destroy(int $id): int
    {
        return $this->requisitionRepository->delete($id);
    }
}
