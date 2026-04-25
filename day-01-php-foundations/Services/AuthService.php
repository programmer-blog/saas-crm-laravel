<?php
class AuthService {
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function login(string $email, string $password): bool {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return false;
        }

        return password_verify($password, $user->password);
    }

       public function register(string $email, string $password): ?User {
        return $this->userRepository->register($email, $password);
    }

    public function getAllUsers(): array {
        return $this->userRepository->getAllUsers();
    }
}