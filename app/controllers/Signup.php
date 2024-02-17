<?php

//SignUp class

class Signup extends Controller{
    
    public function index()
    {
        // $db = new Database();
        // $db->create_tables();
        
        $user = new User();
        if($result = $user->validate($_POST)){
            // $query = "insert into users(firstname,lastname,email,password,role,date) values (:firstname, :lastname, :email, :password, :role, :date)";

            // $arr['firstname'] = $_POST['firstname'];
            // $arr['lastname'] = $_POST['lastname'];
            // $arr['email'] = $_POST['email'];
            // $arr['password'] = $_POST['password'];
            // $arr['role'] = "user";
            // $arr['date'] = date("Y-m-d H:i:s");

            // $db = new Database();
            // $db->query($query, $arr);

            $_POST['date'] = date("Y-m-d H:i:s");
            $user->insert($_POST);
        }
        
        // var_dump($result);
        // show($_POST);

        show($user->errors);
        $data['title'] = "Signup";

        $this->view('signup', $data);
    }
}