<?php
  class User {
    private $db;
    private $errors = [];

    public function __construct(){
      $this->db = new Database;
    }

    //register
    public function register($data){
      $validation_code = token_generator();
      $date = date('Y-m-d H:i:s');
      //$validation_code = md5($data['name'] + microtime());
      $email = $data['email'];

      $this->db->query('INSERT INTO users(firstname, lastname, email, dob, gender, address, validation_code, password, is_activated, acount_created_at) VALUES (:firstname, :lastname, :email, :dob, :gender, :address, :validation_code, :password, 0, :acount_created_at)');
      $this->db->bind(':firstname', $data['firstname']);
      $this->db->bind(':lastname', $data['lastname']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':dob', $data['dob']);
      $this->db->bind(':gender', $data['gender']);
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':validation_code', $validation_code);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':acount_created_at', $date);
      //$this->db->bind(':password', $active);

      if($this->db->execute()){

        $subject = "FriendMii Account Activation";
        $message = '<h4>Welcome to FriendMii</h4>
          <p>Please click the link below to activate your account</p>
             <a href="http://localhost/testproject/users/activate?email='.$email.'&code='.$validation_code.'">Activate your account</a>';
        #$header = "From: noreply@SITENAME.com";

        if(verification_email($email, $subject, $message)){
          return true;
        }else {
          return false;
        }

        
      }else{
        return false;
      }

    }

    public function activate_user(){
      //$validation_code = token_generator();
      if($_SERVER['REQUEST_METHOD'] == "GET"){

        if (isset($_GET['email'])) {

          $email = $_GET['email'];
          $validation_code = $_GET['code'];

          $this->db->query("SELECT * FROM users WHERE email = '".$_GET['email']."' AND validation_code = '".$_GET['code']."' ");
          $results  = $this->db->resultset();
          //print_r($results);
          if($this->db->rowCount($results) == 1){
            $this->db->query("UPDATE users SET is_activated = 1, validation_code = 0 WHERE email = '".$email."' AND validation_code = '".$validation_code."' ");
            if($this->db->execute()){
              //return true;
              flash('account_activated', 'Your account was successfully activated. You can login!');
              redirect('users/login');
            }else{
              return false;
            }
          }else{
            flash('account_activated', '<span class="text-danger">Sorry your account could not be activated!</span>');
            redirect('users/login');
          }
          return $results;
        }
      }
    }
    //check if user email exists
    public function email_exist($email){

      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->resultset();
      //$my = $this->db->rowCount($row);
      //die(print_r($my, true));

      if($this->db->rowCount($row) > 0){
        return true;
      } else{
        return false;
      }
    }

    //check if users acount is activated
    public function is_activated($email){
        $this->db->query('SELECT * FROM users WHERE email = :email AND is_activated = 1');
        $this->db->bind(':email', $email);

        $rows = $this->db->resultset();

        //die(print_r($rows, true));
        if($this->db->rowCount($rows) > 0){
          return true;
        }else {
          return false;
        }
      }
    //log in 
    public function login($email, $password, $remember = false){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind('email', $email);

      $row = $this->db->single();
      //die(print_r($row, true));

      @$password_hash = $row->password;
      
      if(password_verify($password, $password_hash)) {

        if($remember){
          // TODO modify in the client side
          setcookie('email', $email, time() + 86400);
          setcookie('password', $password, time() + 86400);
        }else {
          unset($_COOKIE['email']);
          setcookie('email', '', time()-86400);
          unset($_COOKIE['password']);
          setcookie('password', '', time()-86400);
        }

        // TODO add logged in time here

        return $row;
      }else{
        return false;
      }
      
    }

    // Find User By ID
    public function getUserById($id){
      $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
      $this->db->bind(':user_id', $id);

      $row = $this->db->single();

      return $row;
    } 

    public function recover_password($email){
      
        if(isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']){
          //$email = $data['email'];
          $validation_code = validation_token();
          
          if($this->email_exist($email) && $this->is_activated($email)){

            setcookie('temp_reset_access', $validation_code, time() + 86400);

            $this->db->query("UPDATE users SET validation_code = '".trim($validation_code)."' WHERE email = '".trim($email)."' ");
            $this->db->execute();
          
            $subject = "Password Reset Link";
            $message = "Here is your password reset code: {$validation_code}<br>
            Click here to reset your password: http://localhost/testproject/users/code?email=$email&code=$validation_code
            ";
            if (verification_email($email, $subject, $message)) {
              return true;
            }else{
              return false;
            }

          }else{
            return false;
            //$this->errors = 'email does not exist';
          }

        }else{
          redirect('pages');
        }

      }
      //check if code is valid the proceed to reset password
      public function validate_code(){
        
        if(isset($_COOKIE['temp_reset_access'])){

          if(!isset($_GET['email']) && !isset($_GET['code'])){

            redirect('pages');

          }elseif (empty($_GET['email']) && empty($_GET['code'])) {

            redirect('pages');
            
          }else {
            if(isset($_POST['code'])){

              $email = $_GET['email'];
              $code = $_GET['code'];
              //die(print_r($code, true));
              $this->db->query("SELECT * FROM users WHERE validation_code = '".trim($code)."' AND email = '".trim($email)."' ");
              $results = $this->db->resultset();
              //print_r($email);

              if($this->db->rowCount($results) > 0){
                flash('reset_pass', 'Please create a new password.');
                redirect("users/reset?email=$email&code=$code");
                //return true;
              }else {
                return false;
              }

            }
            
          }
        }else {
          flash('error', '<span class="text-danger">Sorry your cookies has expired, please try again</span>');
          redirect('users/recover');
        }
      
      }

      //reset password 

      public function reset_password($data){

        if(isset($_COOKIE['temp_reset_access'])){

          if(isset($_SESSION['token']) && isset($_POST['token'])){

            if($_POST['token'] === $_SESSION['token']) {

              if(isset($_GET['email']) && isset($_GET['code'])){
                //if(isset($_POST['button'])){}
                  $this->db->query("UPDATE users SET password = :password, validation_code = 0 WHERE email = '".trim($_GET['email'])."' ");
                  $this->db->bind(':password', $data['password']);

                  if($this->db->execute()){
                    return trure;
                  }else{
                    return false;
                  }

              }else{
                redirect('users/code');
              }
            }
          }else {
            redirect('pages');
          }
        }else{
          flash('error', '<span class="text-danger">Sorry your time has expired, please try again</span>');
          redirect('users/recover');
        }
      }

  //  public function lastlogin(){
  //   $date = date('Y-m-d H:i:s');

  //  }


  }
