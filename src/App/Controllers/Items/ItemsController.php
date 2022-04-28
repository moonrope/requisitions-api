<?php

namespace Src\App\Controllers\Items;

use App\Http\Controllers\Controller;
use Domain\Items\Service\ItemService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Src\App\Requests\items\DestroyItemRequest;
use Src\App\Requests\items\ShowItemRequest;
use Src\App\Requests\items\StoreItemRequest;
use Src\App\Requests\items\UpdateItemRequest;
use function response;

class ItemsController extends Controller
{
    public function __construct(
        private ItemService $itemService
    ){
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|Collection
     */
    public function index(): Collection|array
    {
        return $this->itemService->index();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreItemRequest $request
     * @return Model
     */
    public function store(StoreItemRequest $request): Model
    {
        return $this->itemService->store($request->getData());
    }

    /**
     * Display the specified resource.
     *
     * @param ShowItemRequest $request
     * @return Model
     */
    public function show(ShowItemRequest $request): Model
    {
        return $this->itemService->show($request->get('itemId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateItemRequest $request
     * @return Model
     */
    public function update(UpdateItemRequest $request): Model
    {
        return $this->itemService->update($request->get('itemId'), $request->getData());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyItemRequest $request
     * @return JsonResponse
     */
    public function destroy(DestroyItemRequest $request): JsonResponse
    {
        if(!$this->itemService->destroy($request->get('itemId'))){
            return response()->json('Error: Item not deleted');
        }
        return response()->json('Success: Item deleted');
    }
}
