<?php
  class Posts extends Controller{
    public function __construct(){
      if(!isset($_SESSION['user_id'])){
        redirect('users/login');
      }
      // Load Models
      $this->postModel = $this->model('Post');
      //$this->userModel = $this->model('User');
    }

    // Load All Posts
    public function index(){
      //$user = $this->postModel->getPosts();

      $data = [
        'title' => 'Logged in'
      ];

      $this->view('posts/index', $data);
    }

    // Show Single Post
    // public function show($id){
    //   $post = $this->postModel->getPostById($id);
    //   $user = $this->userModel->getUserById($post->user_id);

    //   $data = [
    //     'post' => $post,
    //     'user' => $user
    //   ];

    //   $this->view('posts/show', $data);
    // }

      // Add Post
      public function post(){
        if(!$_SESSION['user_id']){
          redirect('users/login');
        }
        $uname = $_SESSION['name'];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Sanitize post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $folder ="assets/posts/";

            $image = $_FILES['image']['name'];

            $path = $folder . $uname . $image ;

            $data = [
                'post_text' => trim($_POST['post_text']),
                'user_id' => trim($_SESSION['user_id']),
                'image' => trim($path)
            ];
            //die(print_r(isset($data['post_text']), true));
            //die(print_r("nooo", true));
            $target_file=$folder.basename($_FILES["image"]["name"]);


            $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

            $file_size =$_FILES['image']['size'];
            //die(print_r($file_size,true));
            $allowed=array('jpeg','png' ,'jpg', 'gif');

            $filename=$_FILES['image']['name'];

            $ext=pathinfo($filename, PATHINFO_EXTENSION);
            //die(print_r(empty($data['image']), true));
            if (empty($data['post_text']) && empty($filename)) {
              flash('error-post', '');
              redirect('posts');
            }

              //die(print_r(isset($filename) && !empty($filename) && !empty($data['post_text']) && !empty($data['image']),true));
              if (isset($filename) && !empty($filename) && !empty($data['post_text']) && !empty($data['image'])) {
                if (in_array($ext,$allowed) && $file_size < 2097152 && $file_size != 0) {
                  if(move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                    if($this->postModel->addPost($data)) {
                      redirect('posts');
                      exit();
                    }else {
                      flash('error-post', '<span class="text-danger">Sorry something went wrong.</span>');
                      redirect('posts');
                    }
                  }
                }
                else{
                  flash('error-post', '<span class="text-danger">Sorry only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
                  redirect('posts');
                }

              }


              if (isset($data['post_text']) && !empty($data['post_text'])) {
                if($this->postModel->addPost($data)) {
                  redirect('posts');
                  exit();
                }else {
                  flash('error-post', '<span class="text-danger">Sorry something went wrong.</span>');
                  redirect('posts');
                }
              }


              //die(print_r(isset($filename) && !empty($filename) && !empty($data['image']), true));
              if (isset($filename) && !empty($filename) && !empty($data['image'])) {
                if (in_array($ext,$allowed) && $file_size < 2097152 && $file_size != 0) {
                  if(move_uploaded_file( $_FILES['image']['tmp_name'], $path)) {
                    if($this->postModel->addPost($data)) {
                      redirect('posts');
                      exit();
                    }else {
                      flash('error-post', '<span class="text-danger">Sorry something went wrong.</span>');
                      redirect('posts');
                    }
                  }
                }else{
                  flash('error-post', '<span class="text-danger">Sorry, only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
                  redirect('posts');
                }
              }


        }else{
            //get existing post from model

            $this->view('posts', $data);
          }

       }

    // // Edit Post
    // public function edit($id){
    //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     // Sanitize POST
    //     $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //     $data = [
    //       'id' => $id,
    //       'title' => trim($_POST['title']),
    //       'body' => trim($_POST['body']),
    //       'user_id' => $_SESSION['user_id'],
    //       'title_err' => '',
    //       'body_err' => ''
    //     ];

    //      // Validate email
    //      if(empty($data['title'])){
    //       $data['title_err'] = 'Please enter name';
    //       // Validate name
    //       if(empty($data['body'])){
    //         $data['body_err'] = 'Please enter the post body';
    //       }
    //     }

    //     // Make sure there are no errors
    //     if(empty($data['title_err']) && empty($data['body_err'])){
    //       // Validation passed
    //       //Execute
    //       if($this->postModel->updatePost($data)){
    //       // Redirect to login
    //       flash('post_message', 'Post Updated');
    //       redirect('posts');
    //       } else {
    //         die('Something went wrong');
    //       }
    //     } else {
    //       // Load view with errors
    //       $this->view('posts/edit', $data);
    //     }

    //   } else {
    //     // Get post from model
    //     $post = $this->postModel->getPostById($id);

    //     // Check for owner
    //     if($post->user_id != $_SESSION['user_id']){
    //       redirect('posts');
    //     }

    //     $data = [
    //       'id' => $id,
    //       'title' => $post->title,
    //       'body' => $post->body,
    //     ];

    //     $this->view('posts/edit', $data);
    //   }
    // }

    // // Delete Post
    // public function delete($id){
    //   if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     //Execute
    //     if($this->postModel->deletePost($id)){
    //       // Redirect to login
    //       flash('post_message', 'Post Removed');
    //       redirect('posts');
    //       } else {
    //         die('Something went wrong');
    //       }
    //   } else {
    //     redirect('posts');
    //   }
    // }
  }
