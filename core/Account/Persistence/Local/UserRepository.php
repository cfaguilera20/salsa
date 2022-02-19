<?php
namespace Core\Account\Persistence\Local;

use Core\Account\Persistence\Local\AbstractLocal;

use Core\Account\Domain\Entity\User;
use Core\Account\Domain\Repository\UserRepositoryInterface;

class UserRepository extends AbstractLocal implements UserRepositoryInterface
{
    public function findByUsername(string $username): ?User
    {
        $data = $this->loadData();

        foreach ($data['users'] as $user) {
            if ($user['username'] === $username) {
                return new User($user['id'], $user['username'], $user['password'], $user['email']);
            }
        }
        return null;
    }

    public function create(User $user): User
    {
        $data = $this->loadData();
        if(isset($data['users']) === false) {
            $data['users'] = [];
        }
        
        $id = uniqid();
        $data['users'] = array_merge($data['users'], [
            [
                'id' => $id,
                'username' => $user->getUsername(),
                'password' => $user->getPassword(),
                'email' => $user->getEmail()
            ]
        ]);

        $this->saveData($data);
        $user->setId($id);
        
        return $user;
    }
    
    public function save(User $user): void
    {
        $data = $this->loadData();

        if(isset($data['users']) === false) {
            $data['users'] = [];
        }

        foreach ($data['users'] as $key => $value) {
            if ($value['id'] === $user->getId()) {
                $data['users'][$key] = [
                    'id' => $user->getId(),
                    'username' => $user->getUsername(),
                    'password' => $user->getPassword(),
                    'email' => $user->getEmail()
                ];
            }
        }

        $this->saveData($data);
    }
}
