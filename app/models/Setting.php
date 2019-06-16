<?php

  class Setting {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }


    //update Profile
    public function updateProfile($data){
      $id = $_SESSION['user_id'];
      $this->db->query('UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, gender = :gender, address = :address WHERE user_id = :user_id');
      $this->db->bind(':firstname', $data['firstname']);
      $this->db->bind(':lastname', $data['lastname']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':gender', $data['gender']);
      $this->db->bind(':address', $data['address']);
      $this->db->bind(':user_id', $id);

      if ($this->db->execute()) {
        return true;
      }else {
        return false;
      }

    }















  }
