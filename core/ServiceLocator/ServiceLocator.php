<?php
namespace Core\ServiceLocator;

class ServiceLocator
{
    private $services = [];

    public function add(string $name, $service)
    {
        $this->services[$name] = $service;
    }

    public function get(string $name)
    {
        return $this->services[$name];
    }
}
