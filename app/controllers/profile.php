<?php

class Profile extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
    }

    public function index(){
        if(!$_SESSION['user_id']){
          redirect('users/login');
        }

        $profile = $this->userModel->getProfile();
        $data = [
            'profile' => $profile,
            'title' => 'Hey this is your profile',
            'description' => 'Lets code',
        ];

        $this->view('profile/index', $data);

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
            redirect('profile');
         }
         else{
            if($this->userModel->updateProfile($data)){
              flash('profile_updated', 'Profile updated');
              redirect('profile');
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
           redirect('profile');
        }
        else{
           if($this->userModel->updateFavourite($data)){
             flash('profile_updated', 'Profile updated');
             redirect('profile');
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
            redirect('profile');
          }else {
            flash('error-profile', '<span class="text-danger">Sorry, something went wrong.</span>');
            redirect('profile');
          }
        }
      }else{
        flash('error-profile', '<span class="text-danger">Sorry, only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
        redirect('profile');
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
              redirect('profile');
            }else {
              flash('error-profile', '<span class="text-danger">Sorry, something went wrong.</span>');
              redirect('profile');
            }
          }
        }else{
          flash('error-profile', '<span class="text-danger">Sorry, only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
          redirect('profile');
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
            redirect('profile');
         }
         else{
            if($this->userModel->updateBio($data)){
              flash('profile_updated', 'Profile updated');
              redirect('profile');
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

  //end update bio..


}
