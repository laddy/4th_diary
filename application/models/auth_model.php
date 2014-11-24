<?php

class Auth_model extends Model
{
    
    public function getAuthUser($id, $pass)
    {
        $id     = $this->escapeString($id);
        $pass   = $this->escapeString($pass);
        
        $result = $this->query('SELECT * FROM something WHERE id="'. $id .'"');
        return $result;
    }

}

