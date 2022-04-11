<?php

namespace App\Http\Requests\Requisitions;

class DestroyRequisitionRequest extends BaseRequisitionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'requisitionUuid' => 'required|exists:requisitions,uuid',
        ];
    }
}
