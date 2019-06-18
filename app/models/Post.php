<?php
  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    //Get All Posts
    public function getPosts(){
      $this->db->query("SELECT *,
                        post.post_id AS post_id,
                        users.user_id AS user_id,
                        users.image AS profile_pic,
                        post.image AS post_image
                        FROM post
                        INNER JOIN users
                        ON post.user_id = users.user_id
                        WHERE closed = '0'
                        ORDER BY post.posted_at DESC;");

      $results = $this->db->resultset();

      return $results;
    }

    // Get Post By ID
    public function getPostById($id){
      $this->db->query("SELECT * FROM post WHERE post_id = :id");

      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Add Post
    public function addPost($data){
      $date = date('Y-m-d H:i:s');
      // Prepare Query
      $this->db->query('INSERT INTO post (user_id, post, posted_at, is_saved, user_closed, closed, image)
      VALUES (:user_id, :post, :posted_at, 0, 0, 0, :image)');
      // Bind Values
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':post', $data['post_text']);
      $this->db->bind(':posted_at', $date);
      $this->db->bind(':image', $data['image']);

      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update Post
    public function updatePost($data){
      //die(print_r($data,true));
      // Prepare Query
      $this->db->query('UPDATE post SET post = :post, image = :image WHERE post_id = :post_id');

      // Bind Values
      $this->db->bind(':post_id', $data['id']);
      $this->db->bind(':post', $data['post_text']);
      $this->db->bind(':image', $data['image']);

      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete Post
    public function deletePost($id){
      // Prepare Query
      $this->db->query('UPDATE post SET closed = 1 WHERE post_id = :id');

      // Bind Values
      $this->db->bind(':id', $id);

      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function search($data)
    {
      $this->db->query("SELECT * FROM post
                                  INNER JOIN users
                                  ON post.user_id = users.user_id
                                  WHERE post LIKE :keyword OR image LIKE :keyword OR posted_at LIKE :keyword OR users.firstname LIKE :keyword OR users.lastname LIKE :keyword ORDER BY id DESC ");
      @$this->db->bind(':keyword', $data['run-away']);
      $results = $this->db->resultset();
      die(print_r($results,true));
      return $results;

    }

  }
