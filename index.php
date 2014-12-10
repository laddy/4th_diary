<?php
session_start();

require 'vendor/autoload.php';
require 'config.php';
// require 'application/common.php';
require 'application/model_rest.php';

$app = new \Slim\Slim([
    'mode'        => 'development',
    'debug'       => $config['debug']
]);

// Config
$app->config([]);

$diaryClass = new diary($config);

$app->get('/', function() use($app) {
    $app->render('top.php');
});

$app->post('/auth/login/', function() use($app, $diaryClass) {
    if ( $diaryClass->auth($_POST) ) {
        $app->redirect('/diary/');
    }
    else {
        $app->redirect('/?login=fail');
    }
});


// Diary初期表示
$app->get('/diary/', function() use($app, $diaryClass) {
    $target_month = !empty($_POST['target_month']) ? htmlspecialchars($_POST['target_month']) : date('Y-m');
    $contents     = $diaryClass->getDiary($target_month);
    $app->render('diaryMain.php');
});

/*
 * data
 * return json
 */
$app->post('/get_diary/', function() use($diaryClass) {
    $target_month = !empty($_POST['target_month']) ? htmlspecialchars($_POST['target_month']) : date('Y-m');
    $contents     = $diaryClass->getDiary($target_month);
    echo json_encode($contents);
});


/*
 * GetDayDiary
 */
$app->post('/getDayDiary/', function() use($diaryClass) {
    $contents = $diaryClass->getDayDiary();
    echo json_encode($contents);
});
/*
 * Write Data
 */
$app->post('/write/', function() use($app, $diaryClass) {
    echo json_encode($diaryClass->writeDiary($_POST));
});

$app->run();
