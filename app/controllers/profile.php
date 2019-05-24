<?php

class Profile extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function index(){
        if(!$_SESSION['user_id']){
          redirect('users/login');
        }
        $data = [
            'title' => 'Hey this is your profile',
            'description' => 'Lets code'
        ];

        $this->view('profile/index', $data);
        
    }





}