<?php

class Auth extends Controller
{

    public function login()
    {
        $SESS = loadHelper('session_helper');
        if ( empty($_POST) )
        {
            exit();
        }


        $Auth  = $this->loadModel('auth_model');
        $login = $Auth->getAuthUser($_POST['username'], $_POST['password']);

        var_dump($login);

        exit();

        if ( $login )
        {
            // $this->
        }

        echo "login";

        // $template = $this->loadView('main_view');
        // $template->render();
    }
    
    public function logout()
    {
        $SESS = loadHelper('session_helper');
        $SESS->destroy();

        $this->redirect('/');
        return true;
    }

    public function regist()
    {
        echo "a";
    }
}


