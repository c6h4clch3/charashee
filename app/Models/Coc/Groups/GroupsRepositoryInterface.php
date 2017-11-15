<?php

namespace App\Models\Groups;

use App\Services\ServiceException;

interface GroupsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function loadAll();

    /**
     * @param int $id
     * @return mixed
     */
    public function loadById(int $id);

    /**
     * @param string $name
     * @return mixed
     */
    public function create(string $name);

    /**
     * @param int $id
     * @param string $name
     * @return mixed
     */
    public function update(int $id, string $name);

    /**
     * @param int $user_id
     * @param int $group_id
     * @throws ServiceException
     */
    public function userOwnsGroupGuard(int $user_id, int $group_id);
}
