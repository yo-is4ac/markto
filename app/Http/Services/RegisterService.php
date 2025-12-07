<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Exception;

class RegisterService {
    public function __construct(
        private UserRepository $userRepository
    ){}

    public function __invoke(array $data)
    {
        try {
            $this->userRepository->store(name: $data['name'], email: $data['email'], password: $data['password']);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
