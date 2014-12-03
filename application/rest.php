<?php

function auth($post)
{
    $db = conn();

    if ( !empty($_SESSION['login']) AND $_SESSION['login'] ) {
        header('/diary/'.date('Y-m'));
    }

    $username  = htmlspecialchars($post['username']);
    $hash_pass = hash_hmac('sha256', $post['password'], '4th_diary_key', false);

    $fetch = $db->prepare('SELECT * FROM users
        WHERE username="'. $username .'" AND password="'. $hash_pass.'"');

    if ( !($fetch->execute()) ){
        return false;
    }

    $result = $fetch->fetch(PDO::FETCH_ASSOC);

    if ( 1 < count($result) AND !empty($result['username']) )
    {
        $update = $db->query('UPDATE users
            SET last_login = "'.date('Y-m-d H:i:s').
            '" WHERE id = '.$result['id']);

        $_SESSION['login']    = true;
        $_SESSION['username'] = $result['username'];

        $login = true;
    }
    else {
        $login = false;
    }

    return $login;
}
