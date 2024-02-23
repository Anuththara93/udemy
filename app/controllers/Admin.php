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

            $folder = "uploads/images/";
            
            if(!file_exists($folder)){
                mkdir($folder, 0777, true);
                file_put_contents($folder. "index.php", "<?php //silence");
                file_put_contents("uploads/index.php", "<?php //silence");
            }

            if($user->edit_validate($data)){

                $allowed = ['image/jpeg', 'image/png'];

                if(!empty($_FILES['image']['name'])){
                    if($_FILES['image']['error'] == 0){

                        if(in_array($_FILES['image']['type'], $allowed)){
                            // everything is good
                            $destination = $folder.time().$_FILES['image']['name'];
                            move_uploaded_file($_FILES['image']['tmp_name'], $destination);

                            $_POST['image'] = $destination;
                            if(file_exists($data['row']->image)){
                                unlink($data['row']->image);
                            }
                        }

                        else{
                            $user->errors['image'] = "This file type is not allowed";
                        }
                    }

                    else{
                        $user->errors['image'] = "Could not upload the image";
                    }
                }

                $user->update($id, $_POST);

                redirect('admin/profile/' .$id);
            }
        }

        $data['title'] = "Profile";
        $data['errors'] = $user->errors;

        $this->view('admin/profile', $data);
    }
}