<?php

namespace Domain\Requisitions\Service;

use Domain\Items\Service\ItemService;
use Domain\Requisitions\Mail\RequisitionMail;
use Domain\Requisitions\Models\Requisition;
use Domain\Requisitions\Repository\RequisitionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class RequisitionService
{
    public function __construct(
        private RequisitionRepository $requisitionRepository,
        private ItemService $itemService,
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
            $requisition = $this->requisitionRepository->store($values);
            $this->sendEmail($requisition);
            return $requisition;
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
        $requisition = $requisition->load('items');
        $this->sendEmail($requisition);
        return $requisition;
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

    private function sendEmail(Requisition|Model $requisition): void {
        Mail::to('miguel@myawesomedomain.com')
            ->queue(new RequisitionMail($requisition));
    }
}
