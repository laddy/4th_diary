<?php

class Diary extends Controller
{
    function __construct()
    {
//        parent::__construct();

        $SESS = $this->loadHelper('session_helper');
        if ( !($SESS->get('login')) )
        {
            $this->redirect('/');
            return false;
        }


    }

    public function index($hoge = 'hoge')
    {
        $diaryModel = $this->loadModel('diary_model');
        $diary      = $diaryModel->getDiary('2014-11-01');

        $template   = $this->loadView('diary_main');
        $template->render();
    }

    public function regist()
    {
        echo "a";
    }
}
