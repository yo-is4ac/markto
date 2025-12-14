<?php

namespace App\Http\Repositories\Contracts;
use App\Models\User;

interface UserContract {
    public function store(string $name, string $email, string $password);
    public function findByEmail(string $email);
    public function doesPasswordMatch(string $passwordFromRequest, string $passwordStored);
    public function createToken(User $user);
}
