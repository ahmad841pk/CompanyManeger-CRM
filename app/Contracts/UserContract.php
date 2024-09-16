<?php

namespace App\Contracts;

use App\Models\User;

interface UserContract
{
    public function findByEmail(string $strEmail): User|null;

    public function checkUserPassword(User $objUser, string $strPassword): bool;
}
