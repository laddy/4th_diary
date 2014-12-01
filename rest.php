<?php
require 'vendor/autoload.php';
require 'config.php';
require 'common.php';

$app = new \Slim\Slim([
    'mode'        => 'development',
    'debug'       => true
]);

$app->post('/auth/login/', function() use($app) {
    $db = conn();

    if ( !empty($_SESSION['login']) AND $_SESSION['login'] ) {
        $this->redirect('/diary.php/');
    }

    $username = htmlspecialchars($_POST['username']);
    $hash_pass = hash_hmac('sha256', $_POST['password'], '4th_diary_key', false);

    $fetch = $db->prepare('SELECT * FROM users
        WHERE username="'. $username .'" AND password="'. $hash_pass.'"');
    $result = $fetch->execute();
    var_dump($result);
    var_dump($fetch->fetchAll(PDO::FETCH_ASSOC));
    exit();

    if ( 1 === count($result) AND !empty($result[0]->username) )
    {
        $user = $result[0];
        $update = $this->execute('UPDATE users
            SET last_login = "'.date('Y-m-d H:i:s').'"
            WHERE id = '.$user->id);

        $_SESSION['login']    = true;
        $_SESSION['username'] = $user->username;

        $login = true;
    }
    else {
        $login = false;
    }
    exit();

    if ( $login ) {
        $this->redirect('/diary/');
    }
    else {
        $this->redirect('/?login=fail');
    }

    $app->redirect('/diary.php/');
});

$app->run();




