<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\UserContract;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserContract {

    public function __construct(
        private User $user
    ){}

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

    public function getUserByEmail(string $email)
    {
        return $this->user::where('email', '=', $email)->first();
    }

    public function exists(string $email)
    {
        if ($this->user->where('email', '=', $email)->exists() === false) {
            throw new Exception('User Not Found');
        }

        return true;
    }

    public function doesPasswordMatch(string $passwordFromRequest, string $passwordStored)
    {
        if (Hash::check($passwordFromRequest, $passwordStored) === false) {
            throw new Exception('Password does not match');
        }

        return true;
    }

    public function getMostRecentCreatedPersonalAccessToken(string $email)
    {
        return $this->user->where('email', '=', $email)->first()
                ->personalAccessToken()
                ->orderBy('created_at', 'desc')
                ->first();
    }

    public function isFirstAccess(string $email)
    {
        return !($this->user->where('email', '=', $email)->first()->personalAccessToken()->exists());
    }

    public function createToken(string $email)
    {
        $token = $this->user->where('email', '=', $email)->first()
                    ->createToken('auth', ['*'], now()->addWeek());

        return $token->plainTextToken;
    }

    public function resetToken(string $email) {
        $user =  $this->user->where('email', '=', $email)->first();

        $user->tokens()->delete();

        return $user->createToken(email: $email);
    }
}
