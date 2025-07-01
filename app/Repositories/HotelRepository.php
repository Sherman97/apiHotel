<?php

namespace App\Repositories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Collection;

class HotelRepository
{
    public function create(array $data): Hotel
    {
        return Hotel::create($data);
    }

    public function all(): Collection
    {
        return Hotel::all();
    }

    public function find(int $id): ?Hotel
    {
        return Hotel::find($id);
    }
}
