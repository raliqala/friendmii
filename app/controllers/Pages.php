<?php
  class Pages extends Controller{
    public function __construct(){

    }
    
    // Load Homepage
    public function index(){
      // If logged in, redirect to posts
      if(isset($_SESSION['user_id'])){
        redirect('posts');
      }
      $token = token_generator();
      //Set Data
      $data = [
        'token' => $token,
        'title' => 'Welcome To Test Project',
        'description' => 'Simple social network built on the TraversyMVC PHP framework'
      ];

      // Load homepage/index view
      $this->view('pages/index', $data);
    }

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0'
      ];

      // Load about view
      $this->view('pages/about', $data);
    }

    public function help(){
      //Set Data
      $data = [
        'version' => '1.0.0'
      ];

      // Load about view
      $this->view('pages/help', $data);
    }

    public function contact(){

      $data = [
        'title' => 'Contact us',
        'description' => 'Contact page'
      ];

      $this->view('pages/contact', $data);
    }
  }
