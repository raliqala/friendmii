<?php

 require_once 'C:\xampp\htdocs\testproject\app\libraries\PHPMailerAutoload.php';
 
  //die(print_r($mail, true));
function verification_email($email, $subject, $message){

    $mail = new PHPMailer(true);
// Instantiation and passing `true` enables exceptions
    //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com;smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = EMAIL;                     // SMTP username
    $mail->Password   = PASS;                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom(EMAIL, 'noreplay@gmail.com');
    $mail->addAddress($email);     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo(EMAIL);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
   // $mail->AltBody = 'Clic here to reset your password: http://localhost/testproject/users/code?email=thabo@gmail.com&code=8cd0093338902939f840fc7e9f2ad628';

	if(!$mail->send()) {
	    return false;
	} else {
	    return true;
  }
  
}

// '<h2>Copy the the code below.</h2>
//     <p>Here is your recovery code:<strong>8cd0093338902939f840fc7e9f2ad628</strong> </p>
//     Clic here to reset your password: http://localhost/testproject/users/code?email=thabo@gmail.com&code=8cd0093338902939f840fc7e9f2ad628