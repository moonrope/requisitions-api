<?php

namespace App\Http\Requests\Requisitions;

use App\Repositories\RequisitionRepository;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequisitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['requisitionUuid' => $this->route('requisition')]);
    }

    public function passedValidation()
    {
        /** @var RequisitionRepository $requisitionRepository */
        $requisitionRepository = app(RequisitionRepository::class);
        $requisition = $requisitionRepository->getByUuid($this->get('requisitionUuid'));
        $this->merge(['requisitionId' => $requisition->id]);
    }
}
