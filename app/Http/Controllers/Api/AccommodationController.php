<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Services\AccommodationService;
use App\Models\Accommodation;
use App\Models\HotelRoom;
use App\Models\Hotel;
use Illuminate\Http\JsonResponse;

class AccommodationController extends Controller
{
    protected $accommodationService;

    public function __construct(AccommodationService $accommodationService)
    {
        $this->accommodationService = $accommodationService;
    }

    public function index(): JsonResponse
    {
        $data = $this->accommodationService->getAll();
        return response()->json($data);
    }

    public function store(StoreAccommodationRequest $request): JsonResponse
    {
        $accommodation = $this->accommodationService->create($request->validated());
        return response()->json($accommodation, 201);
    }

    public function show(int $id): JsonResponse
    {
        $accommodation = $this->accommodationService->findById($id);
        return response()->json($accommodation);
    }

    public function update(UpdateAccommodationRequest $request, int $id): JsonResponse
    {
        $accommodation = $this->accommodationService->update($id, $request->validated());
        return response()->json($accommodation);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->accommodationService->delete($id);
        return response()->json(null, 204);
    }

    public function byHotel($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);

        $assigned = HotelRoom::with(['accommodation','roomType'])
            ->where('hotel_id', $hotelId)
            ->get();

        return response()->json([
                'hotel'          => $hotel,
                'accommodations' => $assigned
            ]);
    }


}
