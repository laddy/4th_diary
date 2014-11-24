<?php

class Test_model extends Model {
    
    public function getDiary()
    {
        
        $result = $this->query('SELECT * FROM users');
        return $result;
    }

}

