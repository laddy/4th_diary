<?php

class Auth_model extends Model
{
    
    public function getAuthUser($id, $pass)
    {
        $id        = $this->escapeString($id);
        $pass      = $this->escapeString($pass);
        $hash_pass = hash_hmac('sha256', $pass, '4th_diary_key', false);

        $result = $this->query('SELECT * FROM users
            WHERE username="'. $id .'" AND password="'. $hash_pass.'"');

        if ( 1 === count($result) AND !empty($result[0]->username) )
        {
            $user = $result[0];
            $update = $this->execute('UPDATE users
                SET last_login = "'.date('Y-m-d H:i:s').'"
                WHERE id = '.$user->id);

            $_SESSION['login']    = true;
            $_SESSION['username'] = $user->username;

            return true;
        }

        return false;
    }

}

