<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Exception;

class TokenService {

    public function __construct
    (private UserRepository $userRepository)
    {}

    public function attemptToAuth(array $data)
    {
        try {
            if ($this->userRepository->exists(email: $data['email']) === true) {
                $user = $this->userRepository->getUserByEmail(email: $data['email']);

                if (
                    $this->userRepository->doesPasswordMatch(passwordFromRequest: $data['password'], passwordStored: $user->password) === true
                ) {
                    $token = $user->createToken('auth', ['*'], now()->addWeek());

                    return $token->plainTextToken;
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
