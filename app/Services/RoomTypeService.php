<?php
namespace App\Services;

use App\Models\RoomType;
use App\Repositories\RoomTypeRepository;
use Illuminate\Database\Eloquent\Collection;

class RoomTypeService
{
    public function __construct(protected RoomTypeRepository $repo) {}

    public function list(): Collection
    {
        return $this->repo->all();
    }

    public function create(array $data): RoomType
    {
        return $this->repo->create($data);
    }

    public function update(RoomType $roomType, array $data): RoomType
    {
        return $this->repo->update($roomType, $data);
    }

    public function delete(RoomType $roomType): bool
    {
        return $this->repo->delete($roomType);
    }
}
