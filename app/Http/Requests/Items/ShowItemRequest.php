<?php

namespace App\Http\Requests\Items;


class ShowItemRequest extends BaseItemRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'itemUuid' => 'required|uuid|string|exists:items,reference'
        ];
    }
}
