<?php
namespace Core\Account\Persistence\Mysql;

use Core\Account\Domain\Entity\User;
use Core\Account\Domain\Repository\UserRepositoryInterface;

class UserRepository extends AbstractMysql implements UserRepositoryInterface
{
    public function findByUsername(string $username): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            return new User($result['id'], $result['username'], $result['password'], $result['email']);
        }
        return null;
    }

    public function create(User $user): User
    {
        $id = uniqid();
        $stmt = $this->db->prepare("INSERT INTO users (id, username, password, email) VALUES (:id, :username, :password, :email)");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':email', $user->getEmail());
        $user->setId($id);
        return $user;
    }
    
    
    public function save(User $user): void
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $stmt->bindValue(':username', $user->getUsername());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->execute();
    }
}
