<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;

class TokenService {

    public function __construct
    (
        private UserRepository $userRepository,
    ){}

    public function attemptToAuth(array $data)
    {
        try {
            if ($this->userRepository->exists(email: $data['email'])) {
                $user = $this->userRepository->getUserByEmail(email: $data['email']);

                if (
                    $this->userRepository->doesPasswordMatch(passwordFromRequest: $data['password'], passwordStored: $user->password)
                ) {
                    if ($this->userRepository->isFirstAccess(email: $user->email)) {
                        return $this->userRepository->createToken(email: $user->email);
                    }

                    $recentToken = $this->userRepository->getMostRecentCreatedPersonalAccessToken(email: $user->email);

                    if (
                        Carbon::now()->greaterThanOrEqualTo(
                            Carbon::parse($recentToken->expires_at)
                        )
                    ) {
                        return $this->userRepository->createToken(email: $user->email);
                    }

                    return 'user logged in another device';
                }
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function resetToken(array $data) {
        try {
             return $this->userRepository->resetToken(email: $data['email']);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
