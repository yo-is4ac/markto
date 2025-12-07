<?php

namespace App\Http\Repositories\Contracts;

interface UserContract {
    public function store(string $name, string $email, string $password);
}
