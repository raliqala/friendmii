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

// function is_valid_password($password) {
//   return preg_match_all('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z])(?=S*[a-z]).{6,}$/', $password);
// }
// if (!empty($errors)) {
//   foreach ($errors as $error) {
//     echo validation_errors($error);
//   }
// }