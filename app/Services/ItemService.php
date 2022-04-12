<?php

namespace App\Services;

use App\Repositories\ItemRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ItemService
{
    public function __construct(
        private ItemRepository $itemRepository
    ){
    }

    public function index(): Collection|array
    {
        return $this->itemRepository->getAll();
    }

    public function show(int $itemId): Model
    {
        return $this->itemRepository
            ->getById($itemId)
            ->load('requisition');
    }

    public function store(array $input): Model
    {
        return $this->itemRepository
            ->store($input)
            ->load('requisition');
    }

    public function update(int $itemId, array $values): Model
    {
        $this->itemRepository->update($itemId, $values);
        return $this->itemRepository->getById($itemId)->load('requisition');
    }

    public function destroy(int $itemId): int
    {
        return $this->itemRepository->delete($itemId);
    }

}
