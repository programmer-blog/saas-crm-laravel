<?php 
interface UserRepositoryInterface {
    public function findByEmail(string $email): ?User;
    public function register(string $email, string $password): ?User;
    public function getAllUsers(): array;
}
