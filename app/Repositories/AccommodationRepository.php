<?php
namespace App\Repositories;

use App\Models\Accommodation;

class AccommodationRepository
{
    public function getAll()
    {
        return Accommodation::all();
    }

    public function findById(int $id): ?Accommodation
    {
        return Accommodation::findOrFail($id);
    }

    public function create(array $data): Accommodation
    {
        return Accommodation::create($data);
    }

    public function update(int $id, array $data): Accommodation
    {
        $accommodation = Accommodation::findOrFail($id);
        $accommodation->update($data);
        return $accommodation;
    }

    public function delete(int $id): void
    {
        Accommodation::destroy($id);
    }
}
