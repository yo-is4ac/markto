<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Exception;

class TokenService {
    public function __construct
    (private UserRepository $userRepository){}

    public function createToken(array $data)
    {
            $user = $this->userRepository->findByEmail(email: $data['email']);

            if ($user === null) throw new Exception(message: 'User not found', code: 404);
            if (! $this->userRepository->doesPasswordMatch(passwordFromRequest: $data['password'], passwordStored: $user->password)) throw new Exception(message: 'Credentials dont match', code: 400);

        return $this->userRepository->createToken(user: $user);
    }
}
