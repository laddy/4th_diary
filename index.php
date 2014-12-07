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


// Diary初期表示
$app->get('/diary/', function() use($app) {
    $target_month = !empty($_POST['target_month']) ? htmlspecialchars($_POST['target_month']) : date('Y-m');
    $contents     = getDiary($target_month);
    $app->render('diaryMain.php');
});

/*
 * data
 * return json
 */
$app->post('/get_diary/', function() {
    $target_month = !empty($_POST['target_month']) ? htmlspecialchars($_POST['target_month']) : date('Y-m');
    $contents     = getDiary($target_month);
    echo json_encode($contents);
});


/*
 * GetDayDiary
 */
$app->post('/getDayDiary/', function() {
    $contents = getDayDiary();
    echo json_encode($contents);
});
/*
 * Write Data
 */
$app->post('/write/', function() use($app) {
    echo json_encode(writeDiary($_POST));
});

$app->run();
