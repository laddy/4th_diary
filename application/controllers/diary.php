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

    public function index($month = '')
    {
        $month      = !empty($month) ? $month : date('Y-m-d');
        $diaryModel = $this->loadModel('diary_model');
        $diary      = $diaryModel->getDiary($month);
        $template   = $this->loadView('diary_main');
        $template->set('contents', $diary);
        $template->set('month', $month);
        $template->set('day', [0=>'月', 1=>'火',2=>'水', 3=>'木', 4=>'金', 5=>'土', 6=>'日']);

        $template->render();
    }

    public function write()
    {
    }

    public function regist()
    {
        echo "a";
    }
}
