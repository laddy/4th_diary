<?php
session_start();

require 'vendor/autoload.php';
require 'config.php';
require 'application/common.php';
require 'application/rest.php';

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

    $login = auth($_POST);
    if ( $login ) {
        $app->redirect('/diary/'.date('Y-m'));
    }
    else {
        $app->redirect('/?login=fail');
    }

});


$app->get('/diary/:date', function($target_date) use($app) {
    $db = conn();
    $target_date = empty($target_date) ? date('Y-m') : $target_date;
    $user_hash   = hash_hmac( 'sha256', $_SESSION['username'], '4th_diary_key', false );

    $result = $db->query('SELECT * FROM contents WHERE user = "'.$user_hash.'"
        AND target_date LIKE "' .substr($target_date, 0, 7).'%"
        ORDER BY target_date DESC'
    );
    if ( !($result->execute()) ){
        return false;
    }

    $contents = [];
    while ( $c = $result->fetch(PDO::FETCH_ASSOC) ) {
        $contents[] = $c;
    }

    $app->render('diaryMain.php',[
        'month'    => $target_date,
        'contents' => $contents,
        'day'      => [0=>'月', 1=>'火', 2=>'水', 3=>'木', 4=>'金', 5=>'土', 6=>'日']
    ]);
});

$app->post('/get_diary/', function() {

    $db = conn();
    $target_date = empty($_POST['target_date']) ? date('Y-m') : date('Y-m', strtotime($_POST['target_date']));
    $user_hash   = hash_hmac( 'sha256', $_SESSION['username'], '4th_diary_key', false );

    $result = $db->query('SELECT * FROM contents WHERE user = "'.$user_hash.'"
        AND target_date LIKE "' .substr($target_date, 0, 7).'%"
        ORDER BY target_date DESC'
    );
    if ( !($result->execute()) ){
        return false;
    }

    $contents = [];
    while ( $c = $result->fetch(PDO::FETCH_ASSOC) ) {
        $contents[] = $c;
    }

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
