<?php

function auth($post)
{
    $db = conn();

    if ( !empty($_SESSION['login']) AND $_SESSION['login'] ) {
        header('/diary/');
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


function getDiary($target_month)
{
    $db          = conn();
    $week        = [0=>'月', 1=>'火', 2=>'水', 3=>'木', 4=>'金', 5=>'土', 6=>'日'];
    $user_hash   = hash_hmac( 'sha256', $_SESSION['username'], '4th_diary_key', false );

    $result = $db->query('SELECT * FROM contents WHERE user = "'.$user_hash.'"
        AND target_date LIKE "' .substr($target_month, 0, 7).'%"
        ORDER BY target_date DESC'
    );
    if ( !($result->execute()) ){
        return false;
    }

    $contents = [];
    while ( $c = $result->fetch(PDO::FETCH_ASSOC) ) {
        $c['day']    = date('j', strtotime($c['target_date']));
        $c['js_day'] = $week[(int)date('w', strtotime($c['target_date']))];
        $contents[]  = $c;
    }

    $res = [
        'year'  => substr($target_month, 0, 4),
        'month' => substr($target_month, 5, 2),
        'diary' => $contents
    ];

    return $res;
}