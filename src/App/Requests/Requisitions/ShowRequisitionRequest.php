<?php

namespace Src\App\Requests\Requisitions;

class ShowRequisitionRequest extends BaseRequisitionRequest
{

    public function rules(): array
    {
        return [
            'requisitionUuid' => 'required|uuid|exists:requisitions,uuid',
        ];
    }
}
