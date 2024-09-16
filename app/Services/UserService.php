<?php

namespace App\Services;

use App\Contracts\UserContract;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserContract
{
    public function __construct(
        private readonly User $model,

    ) {}

    public function findByEmail(string $strEmail): User|null
    {
        $objQuery = $this->model->newQuery();

        return $objQuery->whereEmail($strEmail)->first();
    }

    public function checkUserPassword(User $objUser, string $strPassword): bool
    {
        return Hash::check($strPassword, $objUser->password);
    }
}
