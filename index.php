<?php
session_start();

require 'vendor/autoload.php';
require 'config.php';
require 'application/common.php';
require 'application/model_rest.php';

$app = new \Slim\Slim([
    'mode'        => 'development',
    'debug'       => $config['debug']
]);


// Config
$app->config([]);

$app->get('/', function() use($app) {
    $app->render('top.php');
});

$app->post('/auth/login/', function() use($app) {
    if ( auth($_POST) ) {
        $app->redirect('/diary/');
    }
    else {
        $app->redirect('/?login=fail');
    }
});


$app->get('/diary/', function() use($app) {

    $target_month = !empty($_POST['target_month']) ? htmlspecialchars($_POST['target_month']) : date('Y-m');
    $contents     = getDiary($target_month);
    $app->render('diaryMain.php');
    /*
    ,[
        'month'    => $target_month,
        'contents' => $contents,
        'day'      => [0=>'月', 1=>'火', 2=>'水', 3=>'木', 4=>'金', 5=>'土', 6=>'日']
    ]);
    */
});

$app->post('/get_diary/', function() {

    $target_month = !empty($_POST['target_month']) ? htmlspecialchars($_POST['target_month']) : date('Y-m');
    $contents     = getDiary($target_month);

    echo json_encode($contents);

/*
    $app->render('diaryMain.php',[
        'month'    => $target_date,
        'contents' => $contents,
        'day'      => [0=>'月', 1=>'火', 2=>'水', 3=>'木', 4=>'金', 5=>'土', 6=>'日']
    ]);
    */
});

$app->run();
