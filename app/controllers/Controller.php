<?php
namespace App\controllers;

class Controller
{
    protected $serviceLocator;

    public function __construct($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        session_start();

        if (!isset($_SESSION['logged_in'])) {
            $_SESSION['logged_in'] = false;
        }
    }

    public function __get($name)
    {
        return $this->serviceLocator->get($name);
    }

    public function __set($name, $value)
    {
        $this->serviceLocator->add($name, $value);
    }

    public function __isset($name)
    {
        return $this->serviceLocator->has($name);
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }
}
