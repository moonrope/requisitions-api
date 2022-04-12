<?php

namespace App\Http\Requests\Items;

use JetBrains\PhpStorm\ArrayShape;

class StoreItemRequest extends BaseItemRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requisition_uuid' => 'required|string|uuid|exists:requisitions,uuid',
            'name' => 'required|string|min:2|max:255'
        ];
    }

    #[ArrayShape(['requisition_id' => "int", 'name' => "string"])] public function getData(): array
    {
        return [
            'requisition_id' => (int)$this->get('requisitionId'),
            'name' => $this->get('name')
        ];
    }
}
