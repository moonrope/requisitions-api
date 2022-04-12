<?php

namespace App\Http\Controllers;

use App\Http\Requests\Items\DestroyItemRequest;
use App\Http\Requests\Items\ShowItemRequest;
use App\Http\Requests\Items\StoreItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;
use App\Services\ItemService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

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
