<?php

//require_once 'C:\xampp\htdocs\testproject\app\libraries\Database.php';

function token_generator(){
  $code = md5(uniqid(mt_rand(), true));
  return $code;
}

function validation_token(){
  $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
  return $token;
}

function UserLikedOrNot($uid,$pid){
  $db = new Database(true);

  $db->query('SELECT * FROM post_like WHERE user_id = :user_id AND post_id = :post_id');
  $db->bind(':user_id', $uid);
  $db->bind(':post_id', $pid);
  $row = $db->resultset();
  //echo print_r($row,true);
  if ($db->rowCount($row) > 0) {
    return true;
  }else {
    return false;
  }

}

function random_username($string_name)
  {
    // echo $string_name."".$rand_no;
     while(true){
          $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
          $username_parts = array_slice($username_parts, 0, 2); //return only first two arry part

          $part1 = (!empty($username_parts[0]))?substr($username_parts[0], 0,8):""; //cut first name to 8 letters
          $part2 = (!empty($username_parts[1]))?substr($username_parts[1], 0,5):""; //cut second name to 5 letters
          $part3 = rand(0, 10000);

          $username = trim($part1).trim($part2).trim($part3); //str_shuffle to randomly shuffle all characters
           //check username in database
          if(username_exist_in_database($username)){
              return $username;
          }else {
            $username = trim($part1).trim($part2).trim($part3);
          }
      }
  }

function username_exist_in_database($username){
  $db = new Database(true);
  $db->query('SELECT * FROM users WHERE username = :username');
  $db->bind(':username', $username);
  $row = $db->resultset();
   if($db->rowCount($row) > 0){
    return false;
   }
   else{
    return true;
   }
}

function onlineOrOffline($status){
  $db = new Database(true);
  $uid = $_SESSION['user_id'];
  $db->query('UPDATE users SET online = :online WHERE user_id = :user_id');
  $db->bind(':online', $status);
  $db->bind(':user_id', $uid);
   if($db->execute()){
     return true;
   }else{
     return false;
   }
}

function following_or_not($senderId, $receiverId){
  $db = new Database(true);
  $db->query('SELECT * FROM follow WHERE sender = :sender AND receiver = :receiver');
  $db->bind(':sender', $senderId);
  $db->bind(':receiver', $receiverId);
  $row = $db->resultset();
  //echo print_r($row,true);
  if ($db->rowCount($row) > 0) {
    return true;
  }else {
    return false;
  }
}
//friend request
// CHECK IF ALREADY FRIENDS
function is_already_friends($my_id, $user_id){
    $db = new Database(true);
    $db->query('SELECT * FROM friends WHERE (user_one = :my_id AND user_two = :frnd_id OR user_one = :frnd_id2 AND user_two = :my_id2)');
    $db->bind(':my_id', $my_id);
    $db->bind(':frnd_id', $user_id);
    $db->bind(':my_id2', $my_id);
    $db->bind(':frnd_id2', $user_id);

    $row = $db->resultset();
    if ($db->rowCount($row) > 0) {
      return true;
    }else {
      return false;
    }

}

//  IF I AM THE REQUEST SENDER
function i_am_sender($my_id, $user_id){
        $db = new Database(true);
        $db->query('SELECT * FROM friend_request WHERE sender = :sender AND receiver = :receiver');
        $db->bind(':sender', $my_id);
        $db->bind(':receiver', $user_id);
        $row = $db->resultset();

        if ($db->rowCount($row) > 0) {
          return true;
        }else {
          return false;
        }
}

//  IF I AM THE RECEIVER
function i_am_receiver($my_id, $user_id){
  $db = new Database(true);
  $db->query('SELECT * FROM friend_request WHERE sender = :sender AND receiver = :receiver');
  $db->bind(':sender', $user_id);
  $db->bind(':receiver', $my_id);
  $row = $db->resultset();

  if ($db->rowCount($row) > 0) {
    return true;
  }else {
    return false;
  }
}

function isMyFriend($userToCheck){
  $db = new Database(true);
  $user_id = $_SESSION['user_id'];
  $db->query('SELECT * FROM users WHERE user_id = :user_id');
  $db->bind(':user_id', $user_id);
  $row = $db->single();
  @$userna = "," . $row->username . ",";
  @$friendArray = $row->friendArray;
  $usernameComma = "," . $userToCheck . ",";

  if ((strstr($friendArray,$usernameComma) || $usernameComma == $userna)) {
    return true;
  }else {
    return false;
  }

}

function getfriends(){
  $db = new Database(true);
  $my_id = $_SESSION['user_id'];
  $return_data = [];
  $db->query('SELECT * FROM friends WHERE (user_one = :my_id OR user_two = :my_id2)');
  $db->bind(':my_id', $my_id);
  $db->bind(':my_id2', $my_id);
  $all_users = $db->resultset();
  foreach($all_users as $row){
      if($row->user_one == $my_id){
          $db->query('SELECT * FROM users WHERE user_id = :user_id');
          $db->bind(':user_id', $row->user_two);
          $results = $db->resultset();
          array_push($return_data, $results);
      }else{
          $db->query("SELECT * FROM users WHERE user_id = :user_id1");
          $db->bind(':user_id1', $row->user_one);
          $results = $db->resultset();
          array_push($return_data, $results);
      }
  }
  //die(print_r($return_data,true));
  return $return_data;
}

// function postsForReload($num){
//   //$num = (isset($_POST['nup'])) ? $_POST['nup'] : '';
//   $db = new Database(true);
//   $db->query('SELECT *
//                       FROM post
//                       INNER JOIN users
//                       ON post.user_id = users.user_id
//                       WHERE post_id < :num AND closed = 0
//                       ORDER BY post.posted_at DESC;');
//   $db->bind(':num', $num);
//   $results = $db->resultset();
//   echo json_encode($results->post);
// }
