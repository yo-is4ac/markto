<?php

namespace App\Http\Repositories\Contracts;

interface UserContract {
    public function store(string $name, string $email, string $password);
    public function getUserByEmail(string $email);
    public function exists(string $email);
    public function doesPasswordMatch(string $passwordFromRequest, string $passwordStored);
    public function isFirstAccess(string $email);
    public function createToken(string $email);
}
