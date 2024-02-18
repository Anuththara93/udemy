<?php

//SignUp class

class Signup extends Controller{
    
    public function index()
    {
        $data['errors'] = [];

        $user = new User();

        if($_SERVER['REQUEST_METHOD'] == "POST"){

            if($result = $user->validate($_POST)){

                $_POST['date'] = date("Y-m-d H:i:s");
                $_POST['role'] = "user";
                $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $user->insert($_POST);

                message("Your profile was successfully created. Please Login");
                redirect('login');
            }
        }

        $data['errors'] = $user->errors;
        $data['title'] = "Signup";

        $this->view('signup', $data);
    }
}