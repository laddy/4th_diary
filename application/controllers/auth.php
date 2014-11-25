<?php

class Auth extends Controller
{

    // Post Only
    public function login()
    {
        if ( empty($_POST) ) {
            exit();
        }
        if ( !empty($_SESSION['login']) AND $_SESSION['login'] ) {
            $this->redirect('diary/');
        }

        $Auth  = $this->loadModel('auth_model');
        $login = $Auth->getAuthUser($_POST['username'], $_POST['password']);

        if ( $login ) {
            $this->redirect('/diary/');
        }
        else {
            $this->redirect('/?login=fail');
        }

        return true;
    }
    
    public function logout()
    {
        session_destroy();

        $this->redirect('/');
        return true;
    }

    public function regist()
    {
        echo "a";
    }
}


