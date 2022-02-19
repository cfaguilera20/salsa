<?php
namespace Core\Account\Domain\Repository;

use Core\Account\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function findByUsername(string $username): ?User;
    public function create(User $user): User;
    public function save(User $user): void;
}
