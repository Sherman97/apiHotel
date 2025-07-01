<?php

namespace App\Repositories;

use App\Models\HotelRoom;
use App\Models\Hotel;


class HotelRoomRepository
{
    /**
     * Encuentra todas las asignaciones de habitaciones para un hotel
     */
    public function findByHotel(int $hotelId)
    {
        return HotelRoom::with(['accommodation', 'roomType'])
            ->where('hotel_id', $hotelId)
            ->get();
    }

    /**
     * Crea una nueva asignación de habitación
     */
    public function create(array $data): HotelRoom
    {
        return HotelRoom::create($data);
    }

    /**
     * Actualiza una asignación existente
     */
    public function update(int $id, array $data): HotelRoom
    {
        $room = HotelRoom::findOrFail($id);
        $room->update($data);
        return $room;
    }

    /**
     * Elimina una asignación
     */
    public function delete(int $id): void
    {
        HotelRoom::destroy($id);
    }

    /**
     * Verifica existencia de combinación
     */
    public function exists(int $hotelId, int $roomTypeId, int $accommodationId): bool
    {
        return HotelRoom::where('hotel_id', $hotelId)
            ->where('room_type_id', $roomTypeId)
            ->where('accommodation_id', $accommodationId)
            ->exists();
    }

    /**
     * Retorna suma de habitaciones asignadas
     */
    public function totalAssignedRooms(int $hotelId): int
    {
        return HotelRoom::where('hotel_id', $hotelId)
                        ->sum('quantity');
    }


    public function totalRoomsHotel(int $hotelId): int
    {
        return Hotel::where('id', $hotelId)
            ->sum('max_rooms');
    }
}
