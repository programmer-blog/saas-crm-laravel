<?php 
require_once 'Contracts/UserRepositoryInterface.php';
require_once 'Models/User.php';
require_once 'DTOs/UserResponseDTO.php';

class InMemoryUserRepository implements UserRepositoryInterface {
    private array $users = [];

    public function __construct() {
        $this->users[] = new User(1, "test@test.com", "123456");
    }

    public function findByEmail(string $email): ?User {
        foreach ($this->users as $user) {
            if ($user->email === $email) {
                return $user;
            }
        }
        return null;
    }

    public function register(string $email, string $password): ?User {
        $user = $this->findByEmail($email);
        if ($user) {
             throw new Exception("User already exists");
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $user = new User(count($this->users) + 1, $email, $hash);
        $this->users[] = $user;
        return $user;
    }

    public function getAllUsers(): array  {  
        return array_map(fn($user) => new UserResponse(
            $user->id,
            $user->email
        ), $this->users);
    }
}
    
