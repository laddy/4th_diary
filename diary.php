<?php

require 'vendor/autoload.php';
require 'config.php';
require 'application/common.php';
require 'application/rest.php';


$app = new \Slim\Slim([
    'mode'  => 'development',
    'debug' => $config['debug']
]);

$app->get('/diary/', function() use($app) {
    echo "aaaaa";
    $app->render('diaryMain.php');
});


$app->post('/get/:date', function($target_date) use ($app) {

    $db = conn();
    $target_date = empty($target_date) ? date('Y-m-d') : $target_date;
    $user_hash = hash_hmac(
        'sha256',
        $_SESSION['username'],
        '4th_diary_key',
        false
    );

    $result = $db->query('SELECT * FROM contents WHERE user = "'.$user_hash.'"
        AND target_date LIKE "' .substr($target_date, 0, 7).'%"
        ORDER BY target_date DESC'
    );

    json_encode($result);
});


$app->run();
