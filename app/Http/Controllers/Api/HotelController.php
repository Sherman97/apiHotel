<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreHotelRequest;
use App\Http\Requests\Hotel\UpdateHotelRequest;
use App\Services\HotelService;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

class HotelController extends Controller
{
    public function __construct(protected HotelService $service) {}

    public function index(): JsonResponse
    {
        $hotels = $this->service->list();
        return response()->json($hotels);
    }

    public function store(StoreHotelRequest $request): JsonResponse
    {   
        $hotel = $this->service->create($request->validated());
        return response()->json($hotel, 201);
    }

    public function show(Hotel $hotel): JsonResponse
    {
        return response()->json($hotel);
    }

    public function update(UpdateHotelRequest $request, Hotel $hotel): JsonResponse
    {
        $updated = $this->service->update($hotel, $request->validated());
        return response()->json($updated);
    }

    public function destroy(Hotel $hotel): JsonResponse
    {
        $this->service->delete($hotel);
        return response()->json(['message' => 'Hotel eliminado con éxito.']);
    }

}
