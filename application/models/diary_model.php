<?php

class Diary_model extends Model {
    
    public function getDiary($target_date = '')
    {
        $target_date = !empty($target_date) ? date('Y-m-d') : $target_date;
        $user_hash = hash_hmac(
            'sha256',
            $_SESSION['username'],
            '4th_diary_key',
            false
        );

        $result = $this->query('SELECT * FROM contents
            WHERE user = "'.$user_hash.'"
            AND target_date = "' .$target_date.'"
            ORDER BY target_date DESC
            '
        );
        return $result;
    }

}

