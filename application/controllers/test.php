<?php

class Test extends Controller {
    
    function index()
    {
        $hoge = $this->loadModel('test_model');
        $ex   = $hoge->getUsers();
        var_dump($ex);
    }
    
    function regist()
    {
        echo "a";
    }
}


