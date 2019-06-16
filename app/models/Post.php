<?php
  class Post {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get All Posts
    // public function getPosts(){
    //   $this->db->query("SELECT *,
    //                     posts.id as postId,
    //                     users.id as userId
    //                     FROM posts
    //                     INNER JOIN users
    //                     ON posts.user_id = users.id
    //                     ORDER BY posts.created_at DESC;");

    //   $results = $this->db->resultset();

    //   return $results;
    // }

    // Get Post By ID
    // public function getPostById($id){
    //   $this->db->query("SELECT * FROM posts WHERE id = :id");

    //   $this->db->bind(':id', $id);

    //   $row = $this->db->single();

    //   return $row;
    // }

    // Add Post
    public function addPost($data){
      $date = date('Y-m-d H:i:s');
      // Prepare Query
      $this->db->query('INSERT INTO post (user_id, post, posted_at, is_saved, user_closed, deleted, image)
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
    // public function updatePost($data){
    //   // Prepare Query
    //   $this->db->query('UPDATE posts SET title = :title, body = :body WHERE id = :id');

    //   // Bind Values
    //   $this->db->bind(':id', $data['id']);
    //   $this->db->bind(':title', $data['title']);
    //   $this->db->bind(':body', $data['body']);

    //   //Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }

    // Delete Post
    // public function deletePost($id){
    //   // Prepare Query
    //   $this->db->query('DELETE FROM posts WHERE id = :id');

    //   // Bind Values
    //   $this->db->bind(':id', $id);

    //   //Execute
    //   if($this->db->execute()){
    //     return true;
    //   } else {
    //     return false;
    //   }
    // }
  }
