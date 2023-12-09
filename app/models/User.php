<?php

//users model

class Userr{
    
    protected $errors = [];
    protected $table = "users";

    public function validate()
    {
        $this->errors = [];
        
        if(empty($this->errors)){
            return true;
        }
        
        return false;
    }
}