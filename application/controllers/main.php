<?php

class Main extends Controller
{
    function __construct()
    {
        // parent::__construct();

        if ( !empty($_SESSION) AND true === $_SESSION['login'] )
        {
            $this->redirect('diary/');
            return true;
        }

    }
    
    public function index()
    {
        $template = $this->loadView('top');
        $template->render();
    }
    
    public function regist()
    {
        echo "a";
    }
}


