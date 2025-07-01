<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Services\RoomTypeService;
use Illuminate\Http\JsonResponse;

class RoomTypeController extends Controller
{
    public function __construct(protected RoomTypeService $service) {}

    public function index(): JsonResponse
    {
        return response()->json($this->service->list());
    }

    public function store(StoreRoomTypeRequest $request): JsonResponse
    {
        $roomType = $this->service->create($request->validated());
        return response()->json($roomType, 201);
    }

    public function update(UpdateRoomTypeRequest $request, RoomType $roomType): JsonResponse
    {
        $updated = $this->service->update($roomType, $request->validated());
        return response()->json($updated);
    }

    public function destroy(RoomType $roomType): JsonResponse
    {
        $this->service->delete($roomType);
        return response()->json(['message' => 'Tipo de habitación eliminado.']);
    }

    public function show(RoomType $roomType): JsonResponse
    {
        return response()->json($roomType);
    }
}
