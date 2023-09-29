<?php

namespace App\Services;

use App\Models\Guild;
use App\Repositories\GuildRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GuildService
{
    private GuildRepository $guildRepository;

    public function __construct(GuildRepository $guildRepository)
    {
        $this->guildRepository = $guildRepository;
    }

    public function fetch(array $filters): LengthAwarePaginator
    {
        return $this->guildRepository->fetch($filters);
    }

    public function create(array $guildData): Guild
    {
        return $this->guildRepository->create($guildData);
    }

    public function update(Guild $guild, array $newGuildData): Guild
    {
        $this->guildRepository->update($guild, $newGuildData);
        return $guild;
    }

    public function delete(Guild $guild): void
    {
        $this->guildRepository->delete($guild);
    }
}
