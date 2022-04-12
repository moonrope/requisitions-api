<?php

namespace App\Http\Requests\Items;

use App\Repositories\ItemRepository;
use App\Repositories\RequisitionRepository;
use Illuminate\Foundation\Http\FormRequest;

class BaseItemRequest extends FormRequest
{
    public function prepareForValidation(): void
    {
        if($this->route('item')){
            $this->merge(['itemUuid' => $this->route('item')]);
        }
    }

    public function passedValidation(): void
    {
        if($this->has('itemUuid')){
            /** @var ItemRepository $itemRepository */
            $itemRepository = app(ItemRepository::class);

            $item = $itemRepository->getByUuid($this->get('itemUuid'), 'reference');
            $this->merge(['itemId' => $item->id]);
        }

        if($this->has('requisition_uuid')){
            /** @var RequisitionRepository $requisitionRepository */
            $requisitionRepository = app(RequisitionRepository::class);
            $requisition = $requisitionRepository->getByUuid($this->get('requisition_uuid'));
            $this->merge(['requisitionId' => $requisition->id]);
        }

    }

}
