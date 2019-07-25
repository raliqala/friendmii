<?php

require_once 'C:\xampp\htdocs\testproject\app\libraries\Database.php';

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

// function random_username($user_name){
//  $new_name = $user_name.mt_rand(0,10000);
//  check_user_name($new_name,$user_name);
//  return $new_name;
// }

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
 if($db->rowCount($row) > 0)
 {
  return false;
 }
 else
 {
  return true;
 }
}

// function sessionX(){
//     $logLength = 1800; # time in seconds :: 1800 = 30 minutes
//     $ctime = strtotime("now"); # Create a time from a string
//     # If no session time is created, create one
//     if(!isset($_SESSION['sessionX'])){
//         # create session time
//         $_SESSION['sessionX'] = $ctime;
//     }else{
//         # Check if they have exceded the time limit of inactivity
//         if(((strtotime("now") - $_SESSION['sessionX']) > $logLength) && $user->isLoggedIn()){
//             # If exceded the time, log the user out
//             $user->logout();
//             exit;
//         }else{
//             # If they have not exceded the time limit of inactivity, keep them logged in
//             $_SESSION['sessionX'] = $ctime;
//         }
//     }
// }
