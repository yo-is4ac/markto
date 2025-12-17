<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Exception;

class RegisterService {
    public function __construct
    (private UserRepository $userRepository){}

    public function __invoke(array $data)
    {
        if ($this->userRepository->findByEmail(email: $data['email'])) throw new Exception(message: 'User already registered', code: 400);

        $user = $this->userRepository->store(name: $data['name'], email: $data['email'], password: $data['password']);

        return $this->userRepository->createToken(user: $user);
    }
}
