<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * User authenticate
     * @param array $attributes
     * @return User
     */
    public function authenticate(array $attributes): User;
}