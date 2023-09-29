<?php

namespace App\Services;

use App\Models\War;
use App\Repositories\WarRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WarService
{
    private WarRepository $warRepository;

    public function __construct(WarRepository $warRepository)
    {
        $this->warRepository = $warRepository;
    }

    public function fetch(array $filters): LengthAwarePaginator
    {
        return $this->warRepository->fetch($filters);
    }

    public function create(array $warData): War
    {
        return $this->warRepository->create($warData);
    }

    public function update(War $war, array $newWarData): War
    {
        $this->warRepository->update($war, $newWarData);
        return $war;
    }

    public function delete(War $war): void
    {
        $this->warRepository->delete($war);
    }
}
