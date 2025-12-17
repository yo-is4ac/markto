<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\UserContract;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserContract {

    public function __construct
    (private User $user){}

    public function store(string $name, string $email, string $password)
    {
        return $this->user->create([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function findByEmail(string $email)
    {
        return $this->user::where('email', '=', $email)->first();
    }

    public function doesPasswordMatch(string $passwordFromRequest, string $passwordStored)
    {
        return Hash::check($passwordFromRequest, $passwordStored);

    }

    public function createToken(User $user)
    {
        $token = $user->createToken('auth', ['*'], now()->addWeek());

        return $token->plainTextToken;
    }
}
