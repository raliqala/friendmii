<?php
  class Posts extends Controller{
    public function __construct(){
      if(!isset($_SESSION['user_id'])){
        redirect('users/login');
      }
      // Load Models
      $this->postModel = $this->model('Post');
      $this->userModel = $this->model('User');
    }

    // Load All Posts
    public function index(){

      $posts = $this->postModel->getPosts();
        $data = [
          'posts' => $posts
      ];

      $this->view('posts/index', $data);
    }

    // Show Single Post
    public function show($id){
      $post = $this->postModel->getPostById($id);
      $user = $this->userModel->getUserById($post->user_id);

      $data = [
        'post' => $post,
        'user' => $user
      ];

      $this->view('posts/show', $data);
    }

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

            $path = $folder . $image ;

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
              flashErr('error-post', '');
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
                      flashErr('error-post', '<span>Sorry something went wrong.</span>');
                      redirect('posts');
                    }
                  }
                }
                else{
                  flashErr('error-post', '<span>Sorry only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
                  redirect('posts');
                }

              }


              if (isset($data['post_text']) && !empty($data['post_text'])) {
                if($this->postModel->addPost($data)) {
                  redirect('posts');
                  exit();
                }else {
                  flashErr('error-post', '<span>Sorry something went wrong.</span>');
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
                      flashErr('error-post', '<span>Sorry something went wrong.</span>');
                      redirect('posts');
                    }
                  }
                }else{
                  flashErr('error-post', '<span>Sorry, only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
                  redirect('posts');
                }
              }


        }else{
            //get existing post from model

            $this->view('posts', $data);
          }

       }

    // // Edit Post
    public function edit($id){
      //die(print_r($id,true));
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $folder ="assets/posts/";

        $image = $_FILES['image']['name'];

        $path = $folder . $image ;

        $data = [
            'post_text' => trim($_POST['post_text']),
            'image' => trim($path),
            'id'  => trim($id),
            'post_text_err' => '',
            'image_err' => ''
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


         // Validate email
         if(empty($data['post_text']) && empty($filename) && !isset($filename)){
           $data['post_text_err'] = 'you cannot post nothing.';
         }


        // Make sure there are no errors
        if(empty($data['post_text_err'])){

          if (isset($filename) && !empty($filename) && !empty($data['post_text']) && !empty($data['image'])) {
            if (in_array($ext,$allowed) && $file_size < 2097152 && $file_size != 0) {
              if(move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                if($this->postModel->updatePost($data)) {
                  redirect('posts');
                  exit();
                }else {
                  flashErr('error-post', '<span>Sorry something went wrong.</span>');
                  redirect('posts');
                }
              }
            }
            else{
              flashErr('error-post', '<span>Sorry only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
              redirect('posts');
            }

          }

          //die(print_r(isset($filename) && !empty($filename) && !empty($data['post_text']) && !empty($data['image']),true));
          if (isset($data['post_text']) && !empty($data['post_text'])) {
            if($this->postModel->updatePost($data)) {
              redirect('posts');
              exit();
            }else {
              flashErr('error-post', '<span>Sorry something went wrong.</span>');
              redirect('posts');
            }
          }


          //die(print_r(isset($filename) && !empty($filename) && !empty($data['image']), true));
          if (isset($filename) && !empty($filename) && !empty($data['image'])) {
            if (in_array($ext,$allowed) && $file_size < 2097152 && $file_size != 0) {
              if(move_uploaded_file( $_FILES['image']['tmp_name'], $path)) {
                if($this->postModel->updatePost($data)) {
                  redirect('posts');
                  exit();
                }else {
                  flashErr('error-post', '<span>Sorry something went wrong.</span>');
                  redirect('posts');
                }
              }
            }else{
              flashErr('error-post', '<span>Sorry, only JPG, JPEG, PNG & GIF  files are allowed AND file size must be less than or equals 2mb.</span>');
              redirect('posts');
            }
          }
        } else {
          // Load view with errors
          $this->view('posts/edit', $data);
        }

      } else {
        // Get post from model
        $post = $this->postModel->getPostById($id);

        // Check for owner
        if($post->user_id != $_SESSION['user_id']){
          redirect('posts');
        }

        $data = [
          'id' => $id,
          'post' => $post->post,
          'image' => $post->image,
        ];

        $this->view('posts/edit', $data);
      }
    }

    // // Delete Post
    public function delete($id){
      //die(print_r($id,true));
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //Execute
        if($this->postModel->deletePost($id)){
          // Redirect to login
          flash('post_message', 'Post Removed');
          redirect('posts');
          } else {
            flashErr('error-post', '<span>Sorry, something went wrong</span>');
            redirect('posts');
          }
      } else {
        redirect('posts');
      }
    }

    public function search(){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
          'run-away' => trim($_POST['search']),
        ];

        $search = $this->postModel->search($data['run-away']);
        if ($search) {
          echo '<script language="javascript">';
          echo 'alert("It works")';  //not showing an alert box.
          echo '</script>';
        }else {
          die('sorry');
        }
      }else {
        echo '<script language="javascript">';
        echo 'alert("not get")';  //not showing an alert box.
        echo '</script>';
      }
    }

  }
