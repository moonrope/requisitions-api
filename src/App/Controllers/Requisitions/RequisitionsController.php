<?php

namespace Src\App\Controllers\Requisitions;

use App\Controllers\Controller;
use Domain\Requisitions\Service\RequisitionService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Src\App\Requests\Requisitions\DestroyRequisitionRequest;
use Src\App\Requests\Requisitions\ShowRequisitionRequest;
use Src\App\Requests\Requisitions\StoreRequisitionRequest;
use Src\App\Requests\Requisitions\UpdateRequisitionRequest;
use function response;

class RequisitionsController extends Controller
{
    public function __construct(
        private RequisitionService $requisitionService
    ){
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|Collection
     */
    public function index(): array|Collection
    {
        return $this->requisitionService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequisitionRequest $request
     * @return Model
     */
    public function store(StoreRequisitionRequest $request): Model
    {
        return $this->requisitionService->store($request->getData());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequisitionRequest $request
     * @return Model|string
     */
    public function show(ShowRequisitionRequest $request): Model|string
    {
        return $this->requisitionService->getById($request->get('requisitionId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequisitionRequest $request
     * @return Model
     */
    public function update(UpdateRequisitionRequest $request): Model
    {
        return $this->requisitionService->update($request->input('requisitionId'), $request->getInputData());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequisitionRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyRequisitionRequest $request): JsonResponse
    {
        if(!$this->requisitionService->destroy($request->input('requisitionId'))){
            return response()->json('Error: requisition not deleted');
        }
        return response()->json('Success: requisition deleted');
    }
}
