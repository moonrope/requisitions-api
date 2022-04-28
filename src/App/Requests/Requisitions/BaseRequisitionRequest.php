<?php

namespace Src\App\Requests\Requisitions;

use Domain\Requisitions\Repository\RequisitionRepository;
use Illuminate\Foundation\Http\FormRequest;
use function app;

class BaseRequisitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    public function prepareForValidation(): void
    {
        if ($this->route('requisition')) {
            $this->merge(['requisitionUuid' => $this->route('requisition')]);
        }
    }

    public function passedValidation(): void
    {
        if ($this->input('requisitionUuid')) {
            /** @var RequisitionRepository $requisitionRepository */
            $requisitionRepository = app(RequisitionRepository::class);
            $requisition = $requisitionRepository->getByUuid($this->input('requisitionUuid'));

            $this->merge(['requisitionId' => $requisition->id]);
        }
    }
}
