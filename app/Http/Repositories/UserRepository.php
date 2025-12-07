<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\UserContract;
use App\Models\User;
use Exception;

class UserRepository implements UserContract {

    public function __construct(
        private User $user
    )
    {}

    public function store(string $name, string $email, string $password)
    {
        try {
            $this->user->create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
