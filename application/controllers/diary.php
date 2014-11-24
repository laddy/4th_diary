<?php

class Diary extends Controller
{
    function __construct()
    {
        parent::__construct();

        $SESS = loadHelper('session_helper');
        if ( !($SESS->get('login')) )
        {
            $this->redirect('/');
            return false;
        }

        else
        {
            $this->redirect('diary/');
        }

    }
    
    public function index()
    {
        echo "login ok";
        /*
        $diaryModel  = $this->loadModel('diary_model');
        $diary = $this->
        $template = $this->loadView('top');
        */

        $template->render();
    }
    
    public function regist()
    {
        echo "a";
    }
}
