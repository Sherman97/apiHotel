<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\HotelRoomService;
use Illuminate\Http\JsonResponse;
use App\Models\Hotel;
use App\Models\HotelRoom;
use App\Http\Requests\StoreHotelRoomRequest;
use App\Http\Requests\UpdateHotelRoomRequest;


class HotelRoomController extends Controller
{
    // ⇩ Solo esta línea, nada más arriba
    protected HotelRoomService $service;

    public function __construct(HotelRoomService $service)
    {
        $this->service = $service;
    }

    public function index(Hotel $hotel): JsonResponse
    {
        $rooms = $this->service->getByHotel($hotel);
        return response()->json([
            'hotel'          => $hotel,
            'accommodations' => $rooms
        ]);
    }

      /**
     * Asignar una nueva combinación de habitación a un hotel
     */
    public function store(Hotel $hotel, StoreHotelRoomRequest $request): JsonResponse
    {
        $room = $this->service->assignRoom($hotel, $request->validated());
        return response()->json($room, 201);
    }

    /**
     * Actualizar una asignación existente
     */
    public function update(Hotel $hotel, HotelRoom $room, UpdateHotelRoomRequest $request): JsonResponse
    {
        $updated = $this->service->updateRoom($hotel, $room->id, $request->validated());
        return response()->json($updated);
    }

    /**
     * Eliminar una asignación de habitación
     */
    public function destroy(Hotel $hotel, HotelRoom $room): JsonResponse
    {
        $this->service->removeRoom($hotel, $room->id);
        return response()->json(null, 204);
    }
}
