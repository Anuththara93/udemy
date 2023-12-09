<?php

//SignUp class

class Signup extends Controller{
    
    public function index()
    {
        // $db = new Database();
        // $db->create_tables();
        
        show($_POST);
        $data['title'] = "Signup";

        $this->view('signup', $data);
    }
}