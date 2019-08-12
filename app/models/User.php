<?php
  class User {
    private $db;
    private $util;

    public function __construct(){
      $this->db = new Database;
      $this->util = new Util;
    }

    //register
    public function register($data){
      //die(print_r(random_username($data['firstname']),true));
      $username = random_username($data['firstname']);
      $validation_code = token_generator();
      //$date = date('Y-m-d H:i:s');
      $datebytimezone = new DateTime("now", new DateTimeZone('UTC') );
	    $date = $datebytimezone->format('Y-m-d H:i:s');
      //$validation_code = md5($data['name'] + microtime());
      $email = $data['email'];
      $firstname = $data['firstname'];
      //$nameFirstChar = $firstname[0];
      //$target_path = createAvatarImage($nameFirstChar);

      $this->db->query('INSERT INTO users(firstname, lastname, username, email, dob, gender, address, validation_code, password, is_activated, acount_created_at, deleted, online) VALUES (:firstname, :lastname, :username, :email, :dob, :gender, :address, :validation_code, :password, 0, :acount_created_at, 0, 0)');
      $this->db->bind(':firstname', $data['firstname']);
      $this->db->bind(':lastname', $data['lastname']);
      $this->db->bind(':username', $username);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':dob', $data['dob']);
      $this->db->bind(':gender', $data['gender']);
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':validation_code', $validation_code);
      $this->db->bind(':password', $data['password']);
      $this->db->bind(':acount_created_at', $date);
      //$this->db->bind(':image', $target_path);

      if($this->db->execute()){

        $subject = "FriendMii Account Activation";
        $message = '<h4>Welcome to FriendMii</h4>
          <p>Please click the link below to activate your account</p>
             <a href="http://localhost/testproject/users/activate?email='.$email.'&code='.$validation_code.'">Activate your account</a>';
        #$header = "From: noreply@SITENAME.com";

        if(verification_email($email, $subject, $message)){
          $pass = 0;
          $sele = 0;
          $this->rememberToken($email, $pass, $sele);
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
      $datebytimezone = new DateTime("now", new DateTimeZone('UTC') );
	    $date = $datebytimezone->format('Y-m-d H:i:s');
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind('email', $email);

      $row = $this->db->single();
      //die(print_r($row, true));

      @$password_hash = $row->password;

      if(password_verify($password, $password_hash) || $this->validateCookie($password)) {

        if($remember){

           $random_password = $this->util->getToken(16);
           $random_selector = $this->util->getToken(16);
           //die(print_r($random_password, true));
           $token_password = password_hash($random_password, PASSWORD_DEFAULT);
           $selector = password_hash($random_selector, PASSWORD_DEFAULT);

           $this->db->query('UPDATE auth SET token_password = :token_password, selector_hash = :selector_hash  WHERE email = :email');
           $this->db->bind(':email', $email);
           $this->db->bind(':token_password', $token_password);
           $this->db->bind(':selector_hash', $selector);

           if($this->db->execute()){
             setcookie('friendmii_ue', $email, time() + 86400);
             setcookie('friendmii_up', $random_password, time() + 86400);
             setcookie('friendmii_us', $random_selector, time() + 86400);
           }else {
             return false;
           }

         }else {
           // TODO delete the temp-pass-token, temp-selector-pass
           unset($_COOKIE['friendmii_ue']);
           setcookie('friendmii_ue', '', time()-86400);

           unset($_COOKIE['friendmii_up']);
           setcookie('friendmii_up', '', time()-86400);

           unset($_COOKIE['friendmii_us']);
           setcookie('friendmii_us', '', time()-86400);

         }

        // TODO updated login time
        try {
          $this->db->query('UPDATE users SET last_active = :last_active WHERE email = :email');
          $this->db->bind(':email', $email);
          $this->db->bind(':last_active', $date);
          $this->db->execute();

        } catch (Exception $e) {
          echo 'Sorry something went wrong: ' .$e->getMessage();
        }


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

    public function lastLogOut($uid){
      $datebytimezone = new DateTime("now", new DateTimeZone('UTC') );
	    $date = $datebytimezone->format('Y-m-d H:i:s');
      $this->db->query('UPDATE users SET logout_time = :logout_time, online = 0 WHERE user_id = :user_id');
      $this->db->bind(':user_id', $uid);
      $this->db->bind(':logout_time', $date);
      $this->db->execute();
    }

    public function getUserIDById($username){
      //die(print_r($username,true));
      $this->db->query("SELECT user_id FROM users WHERE username = :username");
      $this->db->bind(':username', $username);

      $row = $this->db->single();
      $userid = $row->user_id;

      return $userid;
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

      //inserting user email to auth table with 0 0 tp and st so that we can update everytime a cookie is set
    public function rememberToken($email, $token_pass, $selector_token){
      $this->db->query('INSERT INTO auth (email, token_password, selector_hash) VALUES(:email, :token_password, :selector_hash)');
      $this->db->bind(':email', $email);
      $this->db->bind(':token_password', $token_pass);
      $this->db->bind(':selector_hash', $selector_token);

      if($this->db->execute()){
        return true;
      }else {
        return false;
      }

    }

    //this function is currently not inuse..
  public function getTokendByEmail($email)
  {
    $this->db->query('SELECT * FROM auth WHERE email = :email');
    $this->db->bind(':email', $email);
    $row = $this->db->single();

    if ($this->db->rowCount($row) > 0) {
      return true;
    }else {
      return false;
    }

  }

  //this function validate the cookies and the password input..
  public function validateCookie($password = null){

      if(isset($_COOKIE["friendmii_ue"]) && isset($_COOKIE["friendmii_up"]) && isset($_COOKIE["friendmii_us"])){
        $member = (isset($_COOKIE['friendmii_ue'])) ? $_COOKIE['friendmii_ue'] : '';

        $this->db->query('SELECT * FROM auth WHERE email = :email');
        $this->db->bind(':email', $member);
        $userToken = $this->db->single();

        @$pass = $userToken->token_password;
        @$selector_hash = $userToken->selector_hash;
        $unputpass =  $password;

        $token_pass = (isset($_COOKIE['friendmii_up'])) ? $_COOKIE['friendmii_up'] : '';
        $token_select = (isset($_COOKIE['friendmii_us'])) ? $_COOKIE['friendmii_us'] : '';
        //die(print_r(password_verify($password, $pass), true));


        if (password_verify($token_pass, $pass) && password_verify($selector_hash, $token_select) || password_verify($pass, $token_pass) && password_verify($token_select, $selector_hash) || password_verify($pass, $token_pass) && password_verify($selector_hash, $token_select) || password_verify($token_pass, $pass) && password_verify($token_select, $selector_hash)) {
          if(password_verify($unputpass, $pass) || password_verify($pass, $unputpass)){
            return true;
          }else{
            $this->util->clearAuthCookie();
          }
        }else {
          $this->util->clearAuthCookie();
        }
      }

   }


   public function getProfile(){
     $user_id = $_SESSION['user_id'];
     $this->db->query('SELECT * FROM users WHERE user_id = :user_id');
     $this->db->bind(':user_id', $user_id);
     $results = $this->db->resultset();
     if ($this->db->rowCount($results) > 0) {
       return $results;
     }else {
       return false;
     }
   }

   //profile functions
   public function userData($id){
     $this->db->query('SELECT * FROM users WHERE user_id = :user_id');
     $this->db->bind(':user_id', $id);
     $results = $this->db->resultset();
     if ($this->db->rowCount($results) > 0) {
       return $results;
     }else {
       return false;
     }
   }

   // //update Profile
   public function updateProfile($data){
     $id = $_SESSION['user_id'];
     $name = $data['firstname'];
     //die(print_r($id,true));
     $this->db->query('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, address = :address, gender = :gender, hobby = :hobby  WHERE user_id = :user_id');
     $this->db->bind(':user_id', $id);
     $this->db->bind(':firstname', $data['firstname']);
     $this->db->bind(':lastname', $data['lastname']);
     $this->db->bind(':email', $data['email']);
     $this->db->bind(':gender', $data['gender']);
     $this->db->bind(':address', $data['address']);
     $this->db->bind(':hobby', $data['hobby']);


     if ($this->db->execute()) {
       $_SESSION['name'] = $name;
       return true;
     }else {
       return false;
     }

   }

   // //update Profile favourites
   public function updateFavourite($data){
     $id = $_SESSION['user_id'];
     //die(print_r($id,true));
     $this->db->query('UPDATE users SET music = :music, movies = :movies, books = :books, animals = :animals   WHERE user_id = :user_id');
     $this->db->bind(':user_id', $id);
     $this->db->bind(':music', $data['music']);
     $this->db->bind(':movies', $data['movies']);
     $this->db->bind(':books', $data['books']);
     $this->db->bind(':animals', $data['animals']);

     if ($this->db->execute()) {
       return true;
     }else {
       return false;
     }

   }

   // //update Profile pictute
   public function updatePro_picture($data){
      $id = $_SESSION['user_id'];
      $_SESSION['profile_pic'] = $data['image'];
      //die(print_r($data,true));
      $this->db->query('UPDATE users SET image = :image WHERE user_id = :user_id');
      $this->db->bind(':user_id', $id);
      $this->db->bind(':image', $data['image']);

      if($this->db->execute()) {
        return true;
      }else {
        return false;
      }

   }

   // //update Profile cover
   public function updatePro_cover($data){
      $id = $_SESSION['user_id'];
      //die(print_r($data,true));
      $this->db->query('UPDATE users SET cover_image = :cover_image WHERE user_id = :user_id');
      $this->db->bind(':user_id', $id);
      $this->db->bind(':cover_image', $data['image']);

      if($this->db->execute()) {
        return true;
      }else {
        return false;
      }

   }

   // //update bio
   public function updateBio($data){
      $id = $_SESSION['user_id'];
      //die(print_r($data,true));
      $this->db->query('UPDATE users SET job_name = :job_name, job_title = :job_title, bio = :bio WHERE user_id = :user_id');
      $this->db->bind(':user_id', $id);
      $this->db->bind(':job_name', $data['job']);
      $this->db->bind(':job_title', $data['position']);
      $this->db->bind(':bio', $data['bio']);

      if($this->db->execute()) {
        return true;
      }else {
        return false;
      }

   }

   public function offlineStatus($data){
     $uid = $_SESSION['user_id'];
     $this->db->query('UPDATE users SET online = :online WHERE user_id = :user_id');
     $this->db->bind(':online', $data['status']);
     $this->db->bind(':user_id', $uid);
      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
   }


 }//end model
