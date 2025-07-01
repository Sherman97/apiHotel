<?php

namespace App\Repositories;

use App\Models\RoomType;
use Illuminate\Database\Eloquent\Collection;

class RoomTypeRepository
{
    public function all(): Collection
    {
        return RoomType::all();
    }

    public function create(array $data): RoomType
    {
        return RoomType::create($data);
    }

    public function update(RoomType $roomType, array $data): RoomType
    {
        $roomType->update($data);
        return $roomType;
    }

    public function delete(RoomType $roomType): bool
    {
        return $roomType->delete();
    }
}
