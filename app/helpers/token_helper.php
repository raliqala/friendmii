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
  $row = $db->single();
  if ($db->rowCount($row) > 0) {
    return $row;
  }else {
    return false;
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
