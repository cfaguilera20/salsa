<?php
namespace App\controllers;

class SessionController extends Controller
{
    public function create()
    {
        $this->serviceLocator->get('templating')->render('header', ['logged_in' => $this->isLoggedIn()]);
        $this->serviceLocator->get('templating')->render('sign-in');
        $this->serviceLocator->get('templating')->render('footer');
    }

    public function store()
    {
        $_SESSION['user'] = 'John';
        $_SESSION['logged_in'] = true;
        header('Location: /');
    }

    public function destroy()
    {
        unset($_SESSION['user']);
        unset($_SESSION['logged_in']);
        session_destroy();
        $this->redirect('/');
    }
}
