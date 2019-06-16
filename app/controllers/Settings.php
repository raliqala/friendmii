<?php

class Settings extends Controller{
  public function __construct(){
    $this->settingModel = $this->model('Setting');
    $this->userModel = $this->model('User');
  }


  // public function index()
  // {
  //   $data = [
  //
  //   ];
  //   $this->view('settings/settings', $data);
  // }

  public function index(){
      if(!$_SESSION['user_id']){
        redirect('users/login');
      }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $gender = (isset($_POST['gender'])) ? $_POST['gender'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        //Sanitize post array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'firstname'       => trim($_POST['firstname']),
            'lastname'        => trim($_POST['lastname']),
            'email'           => trim($_POST['email']),
            'address'         => trim($address),
            'gender'          => trim($gender),
            'firstname_err'   => '',
            'lastname_err'    => '',
            'email_err'       => '',
            'address_err'     => '',
            'gender_err'      => ''
        ];

        if(empty($data['firstname'])){
          $data['firstname_err'] = 'First name field is required';
        }else{
          if(strlen($data['firstname']) > 32){
            $data['firstname_err'] = 'First name must not have more than 32 characters';
          }
        }
        if(empty($data['lastname'])){
          $data['lastname_err'] = 'Last name field is required';
        }else{
          if(strlen($data['lastname']) > 32){
            $data['lastname_err'] = 'Last name must not have more than 32 characters';
          }
        }

        // Validate email
        if(empty($data['email'])){
            $data['email_err'] = 'Email address is required';
            // Validate name
         }

         if(empty($data['gender'])){
           $data['gender_err'] = 'Please select your gender';
         }

         if(empty($data['address'])){
           $data['address_err'] = 'Address field is required';
         }

        //check if errors are present
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['gender_err']) && empty($data['address_err']) && empty($data['email_err'])){
            $update = $this->settingModel->updateProfile($data);
            //validated
            if($update){
              echo '<script language="javascript">';
              echo 'alert("Profile updated")';  //not showing an alert box.
              echo '</script>';
            }else{
              echo '<script language="javascript">';
              echo 'alert("Sorry something went wrong")';  //not showing an alert box.
              echo '</script>';
            }

        }else{
            //load view with errors
            $this->view('settings/index', $data);
        }

    }else{
        //get existing post from model
        $id = $_SESSION['user_id'];
        $user = $this->userModel->getUserById($id);

        //check for owner
        // if($user->user_id != $_SESSION['user_id']){
        //     redirect('posts');
        // }
        $data = [
          'firstname'   => $user->firstname,
          'lastname'    => $user->lastname,
          'email'       => $user->email,
          'address'     => $user->address,
          'gender'      => $user->gender,
        ];
        $this->view('settings/index', $data);
    }



   }

 }
