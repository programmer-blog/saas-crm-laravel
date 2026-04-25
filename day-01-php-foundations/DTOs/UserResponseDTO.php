<?php
class UserResponse {
    public function __construct(
        public int $id,
        public string $email
    ) {}
}