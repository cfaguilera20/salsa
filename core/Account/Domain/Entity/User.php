<?php
namespace Core\Account\Domain\Entity;

class User
{
    private $id;
    private $username;
    private $email;
    private $password;

    public function __construct(string $id = null, string $username, string $password, string $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    
    /**
     * Get the value of id
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId(string $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername(string $username)
    {
        if ($username === '') {
            throw new \InvalidArgumentException('Username cannot be empty');
        }

        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        if ($email === '') {
            throw new \InvalidArgumentException('Email cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email is not valid');
        }
        
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword(string $password)
    {
        if (strlen($password) < 8) {
            throw new \InvalidArgumentException('Password must be greater than 8 characters');
        }

        $this->password = $password;

        return $this;
    }
}
