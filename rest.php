<?php

require 'vendor/autoload.php';
require 'config.php';
require 'application/common.php';
require 'application/rest.php';


$app = new \Slim\Slim([
    'mode'  => 'development',
    'debug' => $config['debug']
]);

$app->post('/auth/login/', function() use($app) {

    $login = auth($_POST);
    if ( $login ) {
    	$app->redirect('/diary.php/');
    }
    else {
        $app->redirect('/?login=fail');
    }

});

$app->run();
