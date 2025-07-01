<?php

namespace App\Services;

use App\Models\Hotel;
use App\Models\RoomType;
use App\Models\Accommodation;
use App\Repositories\HotelRoomRepository;
use Illuminate\Validation\ValidationException;

class HotelRoomService
{
    public function __construct(protected HotelRoomRepository $repo) {}

    public function getByHotel(Hotel $hotel)
    {
        return $this->repo->findByHotel($hotel->id);
    }

    public function updateRoom(Hotel $hotel, $roomId, array $data)
    {
        return $this->repo->update($roomId, $data);
    }

    /**
     * Elimina una asignación de habitación
     */
    public function removeRoom(Hotel $hotel, $roomId)
    {
        $this->repo->delete($roomId);
    }

    public function assignRoom(Hotel $hotel, array $data)
    {
        // Validar si ya existe esa combinación
        if ($this->repo->exists($hotel->id, $data['room_type_id'], $data['accommodation_id'])) {
            throw ValidationException::withMessages([
                'combination' => 'Esta combinación ya existe para este hotel.'
            ]);
        }

        // Validar tipo vs acomodación
        $roomType = RoomType::find($data['room_type_id'])->name;
        $accommodation = Accommodation::find($data['accommodation_id'])->name;

        $validOptions = [
            'ESTÁNDAR' => ['SENCILLA', 'DOBLE'],
            'JUNIOR' => ['TRIPLE', 'CUÁDRUPLE'],
            'SUITE' => ['SENCILLA', 'DOBLE', 'TRIPLE'],
        ];

        if (!in_array($accommodation, $validOptions[$roomType])) {
            throw ValidationException::withMessages([
                'accommodation_id' => 'Acomodación no válida para este tipo de habitación.'
            ]);
        }

        // Validar límite de habitaciones
        //$currentTotal = $this->repo->totalRoomsHotel($hotel->id);
        $totalAvailable = $this->repo->totalAssignedRooms($hotel->id);
        
        if (($totalAvailable + $data['quantity']) > $hotel->max_rooms) {
            throw ValidationException::withMessages([
                'quantity' => 'La cantidad total supera el máximo de habitaciones del hotel.'
            ]);
        }

        // Guardar habitación
        return $this->repo->create([
            'hotel_id' => $hotel->id,
            'room_type_id' => $data['room_type_id'],
            'accommodation_id' => $data['accommodation_id'],
            'quantity' => $data['quantity']
        ]);
    }
}
