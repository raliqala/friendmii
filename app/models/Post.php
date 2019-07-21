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
      $this->db->query('INSERT INTO post (user_id, post, posted_at, like_count, closed, image)
      VALUES (:user_id, :post, :posted_at, 0, 0, :image)');
      // Bind Values
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':post', $data['post_text']);
      $this->db->bind(':posted_at', $date);
      //$this->db->bind(':privacy', $data['privacy']);
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
      $this->db->query('UPDATE post SET closed = 1 WHERE post_id = :post_id');
      // Bind Values
      $this->db->bind(':post_id', $id);
      //Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // public function search($data){
    //
    //   $this->db->query("SELECT post FROM post WHERE post LIKE :keyword ORDER BY post_id DESC ");
    //   $this->db->bind(':keyword', $data['search_key']);
    //   $results = $this->db->execute();
    //
    //   foreach ($results as $key) {
    //     die(print_r($key,true));
    //   }
    //
    // }

    public function userPost($post_user){
      $this->db->query('SELECT *,
                                 users.image AS profile_pic,
                                 post.image AS post_image
                                 FROM post
                                 INNER JOIN users
                                 ON post.user_id = users.user_id
                                 WHERE closed = 0 AND post.user_id = :post_user ORDER BY post.posted_at DESC');
      $this->db->bind(':post_user', $post_user);
      $results = $this->db->resultset();
      //die(print_r($results,true));
      return $results;
    }

    public function countPost($post_user){
      $this->db->query('SELECT COUNT("post_id") AS Total_Posts FROM post WHERE post.user_id = :post_user AND closed = 0');
      $this->db->bind(':post_user', $post_user);
      $count = $this->db->resultset();
      //die(print_r($count,true));
      return $count;
    }

    public function saved_post_exist($id)
    {
      $user_id = $_SESSION['user_id'];

      $this->db->query('SELECT * FROM save_post WHERE post_id = :post_id AND user_id = :user_id');

      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':post_id', $id);

      $row = $this->db->resultset();

      if ($this->db->rowCount($row) > 0) {
        return true;
      }else {
        return false;
      }


    }

    public function save_Post($data){
      $date = date('Y-m-d H:i:s');
      $this->db->query('INSERT INTO save_post (user_id, post_id, saved_on) VALUES (:user_id, :post_id, :saved_on )');

      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':post_id', $data['post_id']);
      $this->db->bind(':saved_on', $date);

      if ($this->db->execute()) {
        return true;
      }else {
        return false;
      }
    }

    public function report_Post($data){
      $date = date('Y-m-d H:i:s');
      $this->db->query('INSERT INTO report_post (user_id, post_id, report_comment, report_date) VALUES (:user_id, :post_id, :report_comment, :report_date)');

      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':post_id', $data['post_id']);
      $this->db->bind(':report_comment', $data['report']);
      $this->db->bind(':report_date', $date);

      if ($this->db->execute()) {
        return true;
      }else {
        return false;
      }
    }

    public function commentPost($data){
      $date = date('Y-m-d H:i:s');
      $this->db->query('INSERT INTO comment (post_id, user_id, comment, commented_at, closed) VALUES (:post_id, :user_id, :comment, :commented_at, 0)');
      $this->db->bind(':post_id', $data['post_id']);
      $this->db->bind(':user_id', $data['user_id']);
      $this->db->bind(':comment', $data['comment_text']);
      $this->db->bind(':commented_at', $date);

      if ($this->db->execute()) {
        return true;
      }else {
        return false;
      }
    }

    public function getComments(){
      $this->db->query('SELECT * FROM comment
                                 INNER JOIN users
                                 ON comment.user_id = users.user_id
                                 WHERE closed = 0 ORDER BY comment.commented_at DESC');

      $results = $this->db->resultset();
      //die(print_r($results,true));
      return $results;
    }

    public function likePost($data){
      $date = date('Y-m-d H:i:s');

        $this->db->query('SELECT * FROM post WHERE post_id = :post_id');
        $this->db->bind(':post_id', $data['post_id']);
        $row = $this->db->single();
        $n = $row->like_count;

        $this->db->query('INSERT INTO post_like (user_id, post_id, liked_on) VALUES (:user_id, :post_id, :liked_on)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);
        $this->db->bind(':liked_on', $date);
        if ($this->db->execute()) {
            $this->db->query("UPDATE post SET like_count = $n+1 WHERE post_id = :post_id");
            $this->db->bind(':post_id', $data['post_id']);
            $this->db->execute();
            return true;
        }else {
          return false;
        }

    }

    public function unlikePost($data){

        $this->db->query('SELECT * FROM post WHERE post_id = :post_id');
        $this->db->bind(':post_id', $data['post_id']);
        $row = $this->db->single();
        $n = $row->like_count;

        $this->db->query('DELETE FROM post_like WHERE user_id = :user_id AND post_id = :post_id');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':post_id', $data['post_id']);

        if ($this->db->execute()) {
            $this->db->query("UPDATE post SET like_count = $n-1 WHERE post_id = :post_id");
            $this->db->bind(':post_id', $data['post_id']);
            $this->db->execute();
            return true;
        }else {
          return false;
        }

    }

  }//end class
