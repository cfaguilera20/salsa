<?php
namespace App\controllers;

use Core\Account\Domain\Entity\User;

class UserController extends Controller
{
    public function index()
    {
        $this->serviceLocator->get('templating')->render('header', ['logged_in' => $this->isLoggedIn()]);
        $this->serviceLocator->get('templating')->render('index');
        $this->serviceLocator->get('templating')->render('footer');
    }

    public function show()
    {
        $user = $this->serviceLocator->get('repository.user')->findByUsername($_SESSION['user']->getUsername());
        $this->serviceLocator->get('templating')->render('header', ['logged_in' => $this->isLoggedIn()]);
        $this->serviceLocator->get('templating')->render('user', ['user' => $user]);
        $this->serviceLocator->get('templating')->render('footer');
    }

    public function create()
    {
        $this->serviceLocator->get('templating')->render('header');
        $this->serviceLocator->get('templating')->render('sign-up');
        $this->serviceLocator->get('templating')->render('footer');
    }

    public function store()
    {
        $this->serviceLocator->get('templating')->render('header');
        $user = new User(
            null,
            $_POST['username'],
            $_POST['password'],
            $_POST['password']
        );
        $user = $this->serviceLocator->get('repository.user')->create($user);
        $_SESSION['user'] = $user;
        $_SESSION['logged_in'] = true;

        $this->redirect('/');
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
