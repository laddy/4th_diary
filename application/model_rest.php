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


function getDayDiary()
{
    if ( empty($_SESSION['username']) ) {
        return false;
    }

    $db          = conn();
    $user_hash   = nameToHash();

    $result = $db->query('SELECT * FROM contents WHERE user = "'.$user_hash.'"
        AND target_date LIKE "' . $_POST['edit_date']. '"');

    if ( !($result->execute()) ){
        return false;
    }

    $temp = $result->fetch(PDO::FETCH_ASSOC);
    $res = [
        'id'          => $temp['id'],
        'fact'        => $temp['cnt_fact'],
        'discover'    => $temp['cnt_discover'],
        'lesson'      => $temp['cnt_lesson'],
        'declaration' => $temp['cnt_declaration']
    ];

    return $res;
}

function writeDiary($post)
{

    $db        = conn();
    $user_hash = nameTohash();

    $post["selectDate"];
    $result = $db->query('SELECT COUNT(*) FROM contents
        WHERE user = "'.$user_hash.'"
        AND target_date = "' . $post['selectDate']. '"');

    // update
    if ( '1' === $result->fetchColumn() )
    {
        $done = $db->query('UPDATE `contents`
            SET `user` = "' . $user_hash . '",
            `updated_at` = "' . date('Y-m-d H:i:s') . '",
            `target_date` = "' . $post['selectDate'] . '",
            `cnt_fact` = "' . $post["fact"] . '",
            `cnt_discover` = "' . $post["discover"] . '",
            `cnt_lesson` = "' . $post["lesson"] . '",
            `cnt_declaration` = "'. $post["declaration"] . '"
            WHERE `user` = "'.$user_hash . '" AND `target_date` = "' . $post['selectDate'].'"');
    }
    else
    {
        $done = $db->query('INSERT INTO `contents`
            (`id`, `user`, `updated_at`, `created_at`,
            `target_date`, `cnt_fact`, `cnt_discover`,
            `cnt_lesson`, `cnt_declaration`)
            VALUES(
                NULL,
                "'.$user_hash.'",
                "'. date('Y-m-d H:i:s') . '",
                "'. date('Y-m-d H:i:s') . '",
                "'.$post['selectDate'].'",
                "'.$post["fact"].'",
                "'.$post["discover"].'",
                "'.$post["lesson"].'",
                "'.$post["declaration"].'"
            )
        ');
    }
   
    return ( $done ) ? json_encode(['status' => 'ok']) : json_encode(['status' => 'ng']);
    
}

