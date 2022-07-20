<?php

namespace Domain\Services;

use Application\Exceptions\ValidationException;
use Database\Interfaces\UserRepositoryInterface;
use Domain\Interfaces\AuthServiceInterface;
use Domain\Interfaces\SessionInterface;
use Ramsey\Uuid\Uuid;

final class AuthService implements AuthServiceInterface
{
    public function __construct(
        private SessionInterface $session,
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function login(
        string $email,
        string $password
    ): bool {
        $user = $this->userRepository->findByEmail($email);

        if (empty($user) === true) {
            return false;
        }

        $loggedIn = password_verify($password, $user->passwordHash);
        if ($loggedIn === false) {
            return false;
        }

        $this->session->set('auth', true);
        $this->session->set('auth-uuid', $user->uuid);
        $this->session->set('auth-is-admin', $user->isAdmin);

        return true;
    }

    public function logout(): void
    {
        $this->session->delete('auth');
        $this->session->delete('auth-uuid');
        $this->session->delete('auth-is-admin');
    }

    public function check(): bool
    {
        $isLoggedIn = $this->session->get('auth');

        if ($isLoggedIn === true) {
            return true;
        }

        return false;
    }

    public function user(): ?array
    {
        if ($this->check() === true) {
            $userUUID = $this->session->get('auth-uuid');

            return $this->userRepository->findByUUID(Uuid::fromString($userUUID));
        }

        return null;
    }

    public static function validateNewPassword(
        string $password,
        string $passwordMatch
    ): void {
        if ($password !== $passwordMatch) {
            throw new ValidationException('Your passwords do not match');
        }
        if (strlen($password) < 16) {
            throw new ValidationException('Your password must be at least 16 characters long');
        }
        if (!preg_match("#[a-zA-Z]{8,}#", $password)) {
            throw new ValidationException('Your password must include at least 8 standard characters');
        }
        if (!preg_match("#[0-9]{4,}#", $password)) {
            throw new ValidationException('Your password must include at least 4 numbers');
        }
        if (!preg_match("#[\W]{4,}#", $password)) {
            throw new ValidationException('Your password must include at least 4 symbols');
        }
    }

    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}