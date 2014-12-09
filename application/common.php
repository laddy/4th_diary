<?PHP

/*
 * Common Function
 */

// connect to MySQL using PDO
function conn()
{
    global $config;
    $db_conn = new PDO(
        'mysql:host='.$config['db_host'].';dbname='.$config['db_name'],
        $config['db_user'],
        $config['db_pass']
    );
    return $db_conn;
}

// user name hmac
function nameToHash()
{
    return hash_hmac( 'sha256', $_SESSION['username'], '4th_diary_key', false );
}