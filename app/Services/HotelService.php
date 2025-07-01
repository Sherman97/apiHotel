<?php

namespace App\Services;

use App\Models\Hotel;
use App\Repositories\HotelRepository;

class HotelService
{
    public function __construct(protected HotelRepository $repository) {}

    public function create(array $data): Hotel
    {
        return $this->repository->create($data);
    }

    public function list(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->repository->all();
    }

    public function update(Hotel $hotel, array $data): Hotel
    {
        $hotel->update($data);
        return $hotel;
    }

    public function delete(Hotel $hotel): bool
    {
        return $hotel->delete();
    }


}
