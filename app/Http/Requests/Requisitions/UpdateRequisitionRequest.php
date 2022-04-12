<?php

namespace App\Http\Requests\Requisitions;

use JetBrains\PhpStorm\ArrayShape;

class UpdateRequisitionRequest extends BaseRequisitionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'requisitionUuid' => 'required|uuid|exists:requisitions,uuid',
            'name' => 'sometimes|string|min:3|max:255',
            'description' => 'sometimes|min:3|max:1000'
        ];
    }


    #[ArrayShape(['name' => "string", 'description' => "string"])] public function getInputData(): array
    {
        return $this->only(['name', 'description']);
    }
}
