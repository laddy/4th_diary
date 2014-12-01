<?php
require 'vendor/autoload.php';
require 'config.php';

$app = new \Slim\Slim([
    'mode'        => 'development',
    'debug'       => $config['debug']
]);


// Config
$app->config([]);

$app->get('/', function() use($app) {
    $app->render('top.php');
});

$app->get('/hello/:name', function($name) {
    echo "Hello, $name";
});

$app->get('/hello/', function() {
    echo "Hello, World";
});

$app->post('/hello/', function() {

});

$app->run();
