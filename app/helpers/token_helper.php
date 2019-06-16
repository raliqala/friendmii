<?php

$errors = [];

function token_generator(){
  $code = md5(uniqid(mt_rand(), true));
  return $code;
}

function validation_token(){
  $token = $_SESSION['token'] = md5(uniqid(mt_rand(), true));
  return $token;
}

function validation_errors($error_message){

  $error_message = <<<DELIMITER
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>Warning!</strong> $error_message.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
        </button>
  </div>
DELIMITER;

  return $error_message;
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
