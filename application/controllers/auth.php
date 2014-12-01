<?php

class Auth extends Controller
{

    // Post Only
    public function login()
    {

    
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


