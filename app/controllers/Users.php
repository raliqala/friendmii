<?php
  class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function index(){
      redirect('welcome');
    }

    public function register(){
      // Check if logged in
      if($this->isLoggedIn()){
        redirect('posts');
      }

      $gender = (isset($_POST['gender'])) ? $_POST['gender'] : '';
      // Check if POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'firstname' => trim($_POST['firstname']),
          'lastname' => trim($_POST['lastname']),
          'email' => trim($_POST['email']),
          'dob' => trim($_POST['dob']),
          'gender' => trim($gender),
          'address' => trim($_POST['address']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'dob_err' => '',
          'gender_err' => '',
          'address_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
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
         }else{
          if($this->userModel->email_exist($data['email'])){
            $data['email_err'] = 'Sorry this email alredy exist';
          }
        }

        if(empty($data['dob'])){
          $data['dob_err'] = 'Please enter your age';
        }else{
          $birth = (date('Y') - 17).'/'.date('01/01');
          if(strtotime($data['dob']) >=  strtotime($birth)){
            $data['dob_err'] = 'Sorry you need to be 18 years or older';
          }
        }

        if(empty($data['gender'])){
          $data['gender_err'] = 'Please select your gender';
        }

        if(empty($data['address'])){
          $data['address_err'] = 'Address field is required';
        }

        // Validate password
        if(empty($data['password'])){
          $data['password_err'] = 'Password field is required';
        } elseif(strlen($data['password']) < 8){
          $data['password_err'] = 'Password must have atleast 8 characters';
        }elseif(!preg_match("#.*^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $data['password'])){
          $data['password_err'] = 'Password must include at least one(number, letter, symbol, capital and small letter)';
        }

        // Validate confirm password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm password.';
        } else{
            if($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Passwords do not match';
            }
        }

        // Make sure errors are empty
        if(empty($data['firstname_err']) && empty($data['lastname_err']) && empty($data['gender_err']) && empty($data['address_err']) && empty($data['dob_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // SUCCESS - Proceed to insert

          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          //Execute
          if($this->userModel->register($data)){
            // Redirect to login
            flash('register_success', 'You are successfully registered, Please activate your account');
            redirect('users/activate');
          } else {
            echo '<script language="javascript">';
            echo 'alert("Sorry something went wrong")';  //not showing an alert box.
            echo '</script>';
          }

        } else {
          // Load View
          $this->view('users/register', $data);
        }
      } else {
        // IF NOT A POST REQUEST

        // Init data
        $data = [
          'firstname' => '',
          'lastname' => '',
          'email' => '',
          'dob' => '',
          'gender' => '',
          'address' => '',
          'password' => '',
          'confirm_password' => '',
          'firstname_err' => '',
          'lastname_err' => '',
          'email_err' => '',
          'dob_err' => '',
          'gender_err' => '',
          'address_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
        ];

        // Load View
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check if logged in
      if($this->isLoggedIn()){
        redirect('posts');
      }

      // Check if POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'remember' => trim(isset($_POST['remember'])),
          'email_err' => '',
          'password_err' => '',
        ];

        // Check for email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter an email address.';
        }

        // Check for name
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter a password.';
        }


        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){

          // Check and set logged in user
          $loggedInUser = $this->userModel->login($data['email'], $data['password'], $data['remember']);
          $activated = $this->userModel->is_activated($data['email']);

          if ($activated) {
            if($loggedInUser){
              // User Authenticated!
              $this->createUserSession($loggedInUser);
            } else {
              $data['password_err'] = 'Incorrect credentials.';
              // Load View
              $this->view('users/login', $data);
            }
          }else {

            echo '<script language="javascript">';
            echo 'alert("The email you privided is not activated or Does not exist")';  //not showing an alert box.
            echo '</script>';

            $this->view('users/login', $data);
          }
        } else {
          // Load View
          $this->view('users/login', $data);
        }

      } else {
        // If NOT a POST

        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'remember' => '',
          'email_err' => '',
          'password_err' => '',
        ];
        // Load View
        $this->view('users/login', $data);
      }

    }

    public function activate(){
      if($this->isLoggedIn()){
        redirect('posts');
      }
      // if(!$_SESSION['user_id']){
      //   redirect('pages');
      // }
      $ress = $this->userModel->activate_user();
      $data = [
        'ress' => $ress,
        'title' => 'Thank you!',
        'description' => 'Email verification has been sent to your email address'
      ];

      $this->view('users/activate', $data);
    }

    public function recover(){
      if($this->isLoggedIn()){
        redirect('posts');
      }
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'email' => trim($_POST['email']),
          'email_err' => '',
          'errors' => ''
        ];

        // Check for email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter an email.';
        }


        // Make sure errors are empty
        if(empty($data['email_err']) ){
          $recover = $this->userModel->recover_password($data['email']);
          $activated = $this->userModel->is_activated($data['email']);

            if($recover){
              flash('email_recov_sent', 'Password recovery code was sent to your email account.');
              redirect('pages');
            }else {
              //echo '<script language="javascript">';
              //echo 'alert("This email does not exist/Error occured")';
              //echo '</script>';
              $data['email_err'] = 'This email does not exist or It was not verified.';
              $this->view('users/recover', $data);
            }

        }else{

          $this->view('users/recover', $data);
        }

      } else {
        // If NOT a POST

        // Init data
        $data = [
          'email' => '',
          'email_err' => '',
          'errors' => ''
        ];

        // Load View
        $this->view('users/recover', $data);
      }
    }

    public function reset(){
      //reset is not finished
      if($this->isLoggedIn()){
        redirect('posts');
      }
      // if(!isset($_GET['email']) && !isset($_GET['code'])){
      //   redirect('pages');
      // }
       // Check if POST
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Check for email
        if(empty($data['password'])){
          $data['password_err'] = 'Password field is required';
        } elseif(strlen($data['password']) < 8){
          $data['password_err'] = 'Password must have atleast 6 characters';
        }elseif(!preg_match("#.*^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $data['password'])){
          $data['password_err'] = 'Password must include at least one(number, letter, symbol, capital and small letter)';
        }

        // Validate confirm password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm password.';
        } else{
            if($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Passwords do not match';
            }
        }
        // Make sure errors are empty
        if(empty($data['confirm_password_err']) && empty($data['password_err'])){
           // Hash Password
           $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          // Check and set logged in user
           $passupdated = $this->userModel->reset_password($data);

          if($passupdated){
            flash('pass_updated', 'Your password was updated you may login');
            redirect('users/login');
          } else {
            echo '<script language="javascript">';
            echo 'alert("Sorry your password could not be updated/Error occured")';  //not showing an alert box.
            echo '</script>';
            // Load View
            $this->view('users/reset', $data);
          }

        } else {
          // Load View
          $this->view('users/reset', $data);
        }

      } else {
        // If NOT a POST

        // Init data
        $data = [
          'password' => '',
          'confirm_password' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load View
        $this->view('users/reset', $data);
      }

    }

    public function code(){
      if($this->isLoggedIn()){
        redirect('posts');
      }
      // if(!isset($_GET['email']) && !isset($_GET['code'])){
      //   redirect('pages');
      // }
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'code' => trim($_POST['code']),
          'code_err' => ''
        ];

        // Check for email
        if(empty($data['code'])){
          $data['code_err'] = 'Please enter a password reset code.';
        }
         // Make sure errors are empty
        if(empty($data['code_err'])){
          $passcode = $this->userModel->validate_code();
          if($passcode){
            flash('reset_pass', 'Please create a new password.');
            redirect("users/reset");
          }else {
            echo '<script language="javascript">';
            echo 'alert("Invalid password reset code/Error occured")';  //not showing an alert box.
            echo '</script>';
            $this->view('users/code', $data);
          }

        }else{

          $this->view('users/code', $data);
        }

      }else{

        $data = [
          'code' => '',
          'code_err' => ''
        ];

        // Load View
        $this->view('users/code', $data);
      }
    }
    // Create Session With User Info
    public function createUserSession($user){
      $_SESSION['user_id'] = $user->user_id;
      $_SESSION['email'] = $user->email;
      $_SESSION['name'] = $user->firstname;
      $_SESSION['image'] = $user->image;
      redirect('posts');
    }

    // Logout & Destroy Session
    public function logout(){
      // if(isset($_COOKIE['email'])){
      //   unset($_COOKIE['email']);
      //   setcookie('email', '', time()-86400);
      // }
      unset($_SESSION['user_id']);
      unset($_SESSION['email']);
      unset($_SESSION['name']);
      session_destroy();
      redirect('users/login');
    }

    // Check Logged In
    public function isLoggedIn(){
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }
  }
