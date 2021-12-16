<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users
     * @param array $attributes
     * @return array
     */
    public function login(array $attributes)
    {
        $user = $this->userRepository->authenticate($attributes);

        auth()->login($user);

        $token = $user->createToken('sanctum')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];     
    }
}