<?php

//Admin class

class Admin extends Controller{
    
    public function index()
    {
        if(!Auth::logged_in()){
            message('Please login to view the admin section');
            redirect('login');
        }

        $data['title'] = "Dashboard";

        $this->view('admin/dashboard', $data);
    }

    public function profile($id = null)
    {
        if(!Auth::logged_in()){
            message('Please login to view the admin section');
            redirect('login');
        }

        $id = $id ?? Auth::getId();

        $user = new User();
        $data['row'] = $user->first(['id' => $id]);

        if($_SERVER['REQUEST_METHOD'] == "POST" && $data['row']){
            $user->update($id, $_POST);

            redirect('admin/profile/' .$id);
        }

        $data['title'] = "Profile";

        $this->view('admin/profile', $data);
    }
}