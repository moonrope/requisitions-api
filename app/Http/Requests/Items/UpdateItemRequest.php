<?php

namespace App\Http\Requests\Items;

use JetBrains\PhpStorm\ArrayShape;

class UpdateItemRequest extends BaseItemRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'itemUuid' => 'required|uuid|string|exists:items,reference',
            'name' => 'required|string|min:2|max:255'
        ];
    }

    #[ArrayShape(['name' => "string"])] public function getData(): array
    {
        return [
            'name' => $this->get('name'),
        ];
    }
}
