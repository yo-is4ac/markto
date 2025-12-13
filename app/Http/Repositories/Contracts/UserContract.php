<?php

namespace App\Http\Repositories\Contracts;

interface UserContract {
    public function store(string $name, string $email, string $password);
    public function findByEmail(string $email);
    public function doesPasswordMatch(string $passwordFromRequest, string $passwordStored);
}
