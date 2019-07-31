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

      $comments = $this->postModel->getComments();
      $posts = $this->postModel->getPosts();
        $data = [
          'comments' => $comments,
          'posts' => $posts,
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
                if (in_array($ext,$allowed)) {
                  if ($file_size < 2097152 && $file_size != 0) {
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                      if($this->postModel->addPost($data)) {
                        redirect('posts');
                        exit();
                      }else {
                        flashErr('error-post', '<span>Sorry, something went wrong</span>');
                        redirect('posts');
                        exit();
                      }
                    }
                  } else {
                    flashErr('error-post', '<span>Sorry, your file is too large it should be less then or equals 2MB.</span>');
                    redirect('posts');
                    exit();
                  }
                } else{
                  flashErr('error-post', '<span>Sorry, only JPG, JPEG, PNG & GIF files are allowed..</span>');
                  redirect('posts');
                  exit();
                }

              }


              if (isset($data['post_text']) && !empty($data['post_text'])) {
                if($this->postModel->addPost($data)) {
                  redirect('posts');
                  exit();
                }else {
                  flashErr('error-post', '<span>Sorry, something went wrong</span>');
                  redirect('posts');
                  exit();
                }
              }


              //die(print_r(isset($filename) && !empty($filename) && !empty($data['image']), true));
              if (isset($filename) && !empty($filename) && !empty($data['image'])) {
                if (in_array($ext,$allowed)) {
                  if ($file_size < 2097152 && $file_size != 0) {
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
                      if($this->postModel->addPost($data)) {
                        redirect('posts');
                        exit();
                      }else {
                        flashErr('error-post', '<span>Sorry, something went wrong</span>');
                        redirect('posts');
                        exit();
                      }
                    }
                  } else {
                    flashErr('error-post', '<span>Sorry, your file is too large it should be less then or equals 2MB.</span>');
                    redirect('posts');
                    exit();
                  }
                }else{
                  flashErr('error-post', '<span>Sorry, only JPG, JPEG, PNG & GIF files are allowed..</span>');
                  redirect('posts');
                  exit();
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
        $postFile = $this->postModel->getPostById($id);
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        //die(print_r(!empty($image),true));
        $temp_name = $_FILES['image']['tmp_name'];
        $file_size =$_FILES['image']['size'];

        if (!empty($image)) {
          $folder ="assets/posts/";
          $path = $folder . $image ;
          $target_file=$folder.basename($_FILES["image"]["name"]);

          $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);

          $allowed=array('jpeg','png' ,'jpg', 'gif');

          $filename=$_FILES['image']['name'];

          $ext=pathinfo($filename, PATHINFO_EXTENSION);

          if(in_array($ext,$allowed)){

            if($file_size < 2097152 && $file_size != 0){
             unlink($postFile->image);
             $data = [
                 'post_text' => trim($_POST['post_text']),
                 'image' => trim($path),
                 'id'  => trim($id),
                 'post_text_err' => '',
                 'image_err' => ''
             ];
             if (move_uploaded_file($temp_name, $path)) {
               if($this->postModel->updatePost($data)) {
                 redirect('posts');
                 exit();
               }else {
                 flashErr('error-post', '<span>Sorry, something went wrong</span>');
                 redirect('posts');
                 exit();
               }
             }

            }
            else{
             flashErr('error-post', '<span>Sorry, your file is too large it should be less then or equals 2MB.</span>');
             redirect('posts');
             exit();
            }
           }
           else{
            flashErr('error-post', '<span>Sorry, only JPG, JPEG, PNG & GIF files are allowed..</span>');
            redirect('posts');
            exit();
           }

        }else {
          $path = $postFile->image;

          $data = [
              'post_text' => trim($_POST['post_text']),
              'image' => trim($path),
              'id'  => trim($id),
              'post_text_err' => '',
              'image_err' => ''
          ];

            if($this->postModel->updatePost($data)) {
              redirect('posts');
              exit();
            }else {
              flashErr('error-post', '<span>Sorry, something went wrong</span>');
              redirect('posts');
              exit();
            }

        }

      } else {
        $this->view('posts', $data);
      }
    }

    // // Delete Post
    public function delete($id){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        //Execute
        $postFile = $this->postModel->getPostById($id);
        // $data = [
        //   'post_id' => trim($_POST['post_id'])
        // ];
        //die(print_r($data,true));
        if (file_exists($postFile->image)) {
          unlink($postFile->image);
          if($this->postModel->deletePost($id)){
              echo json_encode(1);
            } else {
              echo json_encode(0);
            }
        }else {
          if($this->postModel->deletePost($id)){
              echo json_encode(1);
            } else {
              echo json_encode(0);
            }
        }
      } else {
        redirect('posts');
      }
    }

    // // Delete Post from user
    public function deleteFromU($id){
      //die(print_r($id,true));
      $postFile = $this->postModel->getPostById($id);
      //die(print_r($postFile->image,true));
      if($_SERVER['REQUEST_METHOD'] == 'GET'){
        //Execute
        if (file_exists($postFile->image)) {
          unlink($postFile->image);
          if($this->postModel->deletePost($id)){
            flash('post_message', 'Post Removed');
            redirect('profile?username='.$_SESSION['name']);
            } else {
              flashErr('error-post', '<span>Sorry, something went wrong</span>');
              redirect('profile?username='.$_SESSION['name']);
              exit();
            }
        }else {
          if($this->postModel->deletePost($id)){
            flash('post_message', 'Post Removed');
            redirect('profile?username='.$_SESSION['name']);
            } else {
              flashErr('error-post', '<span>Sorry, something went wrong</span>');
              redirect('profile?username='.$_SESSION['name']);
              exit();
            }
        }
      } else {
        redirect('profile?username='.$_SESSION['name']);
      }
    }

    public function savePost($id){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Sanitize
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'user_id' => trim($_SESSION['user_id']),
            'post_id'  => trim($id),
        ];

        if ($this->postModel->saved_post_exist($id)) {
          echo json_encode(0);
        }else {
          if ($this->postModel->save_Post($data)) {
            echo json_encode(1);
          }else {
            echo json_encode(0);
          }
        }

      }else {
        redirect('posts');
      }
    }

    public function reportPost($id){

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Sanitize
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'user_id' => trim($_SESSION['user_id']),
            'post_id'  => trim($id),
            'report' => trim($_POST['report']),
        ];

          if ($this->postModel->report_Post($data)) {
            flash('report_message', 'Report recieved');
            redirect('posts');
          }else {
            flashErr('error-post', '<span>Sorry, something went wrong</span>');
            redirect('profile');
            exit();
          }

      }else {
        redirect('posts');
      }
    }

    public function AddComment(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'user_id' => trim($_SESSION['user_id']),
          'post_id' => trim($_POST['pid']),
          'comment_text' => trim($_POST['comment_text']),
        ];

        if ($this->postModel->commentPost($data)) {
          echo json_encode(1);
        }else {
          echo json_encode(0);
        }


      }else {
        redirect('posts');
      }

    }

    public function AddLike(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'user_id' => trim($_SESSION['user_id']),
          'post_id' => trim($_POST['postid']),
          'liked'   => trim($_POST['liked'])
        ];

        if ($this->postModel->likePost($data)) {
          echo json_encode(1);
        }else {
          echo json_encode(0);
        }


      }else {
        redirect('posts');
      }
    }

    public function removeLike(){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'user_id' => trim($_SESSION['user_id']),
          'post_id' => trim($_POST['postid']),
          'unliked'   => trim($_POST['unliked'])
        ];

        if ($this->postModel->unlikePost($data)) {
          echo json_encode(1);
        }else {
          echo json_encode(0);
        }


      }else {
        redirect('posts');
      }
    }


  }//end class
