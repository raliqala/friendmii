<?php

class Profile extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
      $this->postModel = $this->model('Post');
    }

    public function index(){
        if(!$_SESSION['user_id']){
          redirect('users/login');
        }

        if (isset($_GET['u']) === true && empty($_GET['u']) === false) {

          $username = trim($_GET['u']);
          $profileId = $this->userModel->getUserIDById($username);
          //die(print_r($profileId,true));
          $profileData = $this->userModel->userData($profileId);
          //die(print_r($profileData,true));
          $user_id = $_SESSION['user_id'];
          $user = $this->userModel->userData($user_id);
          $UserPost = $this->postModel->userPost($profileId);
          $CountPost = $this->postModel->countPost($profileId);

          $data = [
              'user' => $user,
              'profileData' => $profileData,
              'PostCount' => $CountPost,
              'userPost' => $UserPost,
              'title' => 'Hey this is your profile',
              'description' => 'Lets code',
          ];

          if (!$profileData) {
            redirect('posts');
          }

          $this->view('profile/index', $data);

        }


    }

//edit profile

    public function edit(){
    if(!$_SESSION['user_id']){
      redirect('users/login');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $gender = (isset($_POST['gender'])) ? $_POST['gender'] : '';
        $address = (isset($_POST['address'])) ? $_POST['address'] : '';
        //Sanitize post array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'firstname' => trim($_POST['firstname']),
            'lastname'  => trim($_POST['lastname']),
            'email'    => trim($_POST['email']),
            'address' => trim($address),
            'gender'   => trim($gender),
            'hobby'    => trim($_POST['hobby']),
            'firstname_err' => '',
            'lastname_err' => '',
            'email_err'  => '',
            'address_err' => '',
            'gender_err' => '',
            'hobby_err' => '',
        ];


        if(empty($data['firstname']) && empty($data['lastname']) && empty($data['email']) && empty($data['address']) && empty($data['gender']) && empty($data['hobby'])){
            redirect('profile?u='.$_SESSION['username']);
         }
         else{
            if($this->userModel->updateProfile($data)){
              flash('profile_updated', 'Profile updated');
              redirect('profile?u='.$_SESSION['username']);
            }else{
              echo '<script language="javascript">';
              echo 'alert("Sorry something went wrong")';  //not showing an alert box.
              echo '</script>';
            }
       }

    }else{
        //return view
        $this->view('profile', $data);
    }



   }

   //edit favourite stuff

   public function favourite(){
   if(!$_SESSION['user_id']){
     redirect('users/login');
   }

   if($_SERVER['REQUEST_METHOD'] == 'POST'){

       //Sanitize post array
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

       $data = [
           'music'    => trim($_POST['music']),
           'movies'    => trim($_POST['movies']),
           'books' => trim($_POST['books']),
           'animals'      => trim($_POST['animals']),
           'music_err' => '',
           'movies_err'    => '',
           'books_err' => '',
           'animals_err'      => ''
       ];

       // check if inputs are empty then conn
       if(empty($data['music']) && empty($data['movies']) && empty($data['books']) && empty($data['animals'])){
           redirect('profile?u='.$_SESSION['username']);
        }
        else{
           if($this->userModel->updateFavourite($data)){
             flash('profile_updated', 'Profile updated');
             redirect('profile?u='.$_SESSION['username']);
           }else{
             echo '<script language="javascript">';
             echo 'alert("Sorry something went wrong")';  //not showing an alert box.
             echo '</script>';
           }
      }

   }else{
       //get existing post from model

       $this->view('profile', $data);
     }

  }

  //add profile picture

  public function pro_picture(){
  if(!$_SESSION['user_id']){
    redirect('users/login');
  }
  $uname = $_SESSION['name'];
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      //Sanitize post array
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $folder ="assets/images/";

      $image = $_FILES['image']['name'];

      $path = $folder . $uname . $image ;

      $data = [
          'image' => trim($path)
      ];
      //die(print_r($data,true));

      $target_file=$folder.basename($_FILES["image"]["name"]);


      $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

      $file_size =$_FILES['image']['size'];
      //die(print_r($file_size,true));
      $allowed=array('jpeg','png' ,'jpg', 'gif');

      $filename=$_FILES['image']['name'];

      $ext=pathinfo($filename, PATHINFO_EXTENSION);

      if(in_array($ext,$allowed) && $file_size < 2097152 && $file_size != 0)
      {
        if(move_uploaded_file( $_FILES['image']['tmp_name'], $path)) {
          if($this->userModel->updatePro_picture($data)) {
            flash('profile_updated', 'Profile updated');
            redirect('profile?u='.$_SESSION['username']);
          }else {
            flash('error-profile', '<span class="text-danger">Sorry, something went wrong.</span>');
            redirect('profile?u='.$_SESSION['username']);
          }
        }
      }else{
        flash('error-profile', '<span class="text-danger">Sorry, only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
        redirect('profile?u='.$_SESSION['username']);
      }

  }else{
      //get existing post from model

      $this->view('profile/index', $data);
    }

 }
//end profile update

    //strat cover_image
    public function pro_cover(){
    if(!$_SESSION['user_id']){
      redirect('users/login');
    }
    $uname = $_SESSION['name'];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Sanitize post array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $folder ="assets/covers/";

        $image = $_FILES['image']['name'];

        $path = $folder . $uname . $image ;

        $data = [
            'image' => trim($path)
        ];
        //die(print_r($data,true));

        $target_file=$folder.basename($_FILES["image"]["name"]);


        $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

        $file_size =$_FILES['image']['size'];
        //die(print_r($file_size,true));
        $allowed=array('jpeg','png' ,'jpg', 'gif');

        $filename=$_FILES['image']['name'];

        $ext=pathinfo($filename, PATHINFO_EXTENSION);

        if(in_array($ext,$allowed) && $file_size < 2097152 && $file_size != 0)
        {
          if(move_uploaded_file( $_FILES['image']['tmp_name'], $path)) {
            if($this->userModel->updatePro_cover($data)) {
              flash('profile_updated', 'Profile updated');
              redirect('profile?u='.$_SESSION['username']);
            }else {
              flash('error-profile', '<span class="text-danger">Sorry, something went wrong.</span>');
              redirect('profile?u='.$_SESSION['username']);
            }
          }
        }else{
          flash('error-profile', '<span class="text-danger">Sorry, only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
          redirect('profile?u='.$_SESSION['username']);
        }

    }else{
        //get existing post from model

        $this->view('profile/index', $data);
      }

    }
//end cover_image

//update_bio job position
    public function update_bio(){
    if(!$_SESSION['user_id']){
      redirect('users/login');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Sanitize post array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'job'    => trim($_POST['job']),
            'position' => trim($_POST['position']),
            'bio'      => trim($_POST['bio']),
            'job_err' => '',
            'position_err'    => '',
            'bio_err' => ''
        ];


        if(empty($data['job']) && empty($data['position']) && empty($data['bio'])){
            redirect('profile?u='.$_SESSION['username']);
         }
         else{
            if($this->userModel->updateBio($data)){
              flash('profile_updated', 'Profile updated');
              redirect('profile?u='.$_SESSION['username']);
            }else{
              echo '<script language="javascript">';
              echo 'alert("Sorry something went wrong")';  //not showing an alert box.
              echo '</script>';
            }
       }

    }else{
        $this->view('profile', $data);
      }

    }//end update bio..

    public function sendFriendRequest(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'my_id' => trim($_SESSION['user_id']),
          'user_id' => trim($_POST['user_id']),
        ];

        if ($this->userModel->is_request_already_sent($data)) {
          redirect('profile?u='.$_SESSION['username']);
        }elseif (is_already_friends($data['my_id'],$data['user_id'])) {
          redirect('profile?u='.$_SESSION['username']);
        }else {
          if ($this->userModel->make_pending_friends($data)) {
            echo json_encode(1);
          }else {
            echo json_encode(0);
          }
        }

      }else {
        redirect('profile?u='.$_SESSION['username']);
      }
    }

    public function cancelFriendRequest(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'my_id' => trim($_SESSION['user_id']),
          'user_id' => trim($_POST['some_id']),
        ];

          if ($this->userModel->cancel_or_ignore_friend_request($data)) {
            echo json_encode(1);
          }else {
            echo json_encode(0);
          }

      }else {
        redirect('profile?u='.$_SESSION['username']);
      }
    }

    public function acceptFriendRequest(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'my_id' => trim($_SESSION['user_id']),
          'user_id' => trim($_POST['some_id']),
        ];

          if ($this->userModel->make_friends($data)) {
            echo json_encode(1);
          }else {
            echo json_encode(0);
          }

      }else {
        redirect('profile?u='.$_SESSION['username']);
      }
    }

    public function unfriend($some_id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'my_id' => trim($_SESSION['user_id']),
          'user_id' => trim($some_id),
        ];

          if ($this->userModel->delete_friends($data)) {
            echo json_encode(1);
          }else {
            echo json_encode(0);
          }

      }else {
        redirect('profile?u='.$_SESSION['username']);
      }
    }


}//end profile class
