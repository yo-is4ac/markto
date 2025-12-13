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
        try {
            return $this->user->create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
        } catch (Exception $e) {
            throw new Exception('Exception occured while trying to register new user', code: 500);
        }
    }

    public function findByEmail(string $email)
    {
        return $this->user::where('email', '=', $email)->first();
    }

    public function doesPasswordMatch(string $passwordFromRequest, string $passwordStored)
    {
        if (Hash::check($passwordFromRequest, $passwordStored) === false) {
            throw new Exception('Password does not match');
        }

        return true;
    }

    public function createToken(User $user)
    {
        $token = $user->createToken('auth', ['*'], now()->addWeek());

        return $token->plainTextToken;
    }
}
