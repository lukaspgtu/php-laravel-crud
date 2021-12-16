<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * User authenticate
     * @param array $attributes
     * @return User
     */
    public function authenticate(array $attributes): User
    {
        $user = $this->user->where('email', $attributes['email'])->first();

        if (Hash::check($attributes['password'], $user->password)) {
            return $user;
        }

        throw ValidationException::withMessages([
            'password' => 'The password is invalid'
        ]);
    }
}