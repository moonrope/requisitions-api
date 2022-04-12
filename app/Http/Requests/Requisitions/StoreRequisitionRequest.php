<?php

namespace App\Http\Requests\Requisitions;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequisitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|min:3|max:1000'
        ];
    }

    public function getData(): array
    {
        return $this->only(['name', 'description']);
    }
}
