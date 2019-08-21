<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <!-- <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/font-awesome/css/font-awesome.css"> -->
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/post.css">
  <link href="<?php echo URLROOT; ?>/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
  <!-- <link href="<?php echo URLROOT; ?>/css/mdb.min.css" rel="stylesheet"> -->
  <!-- <script type="text/javascript" src="<?php echo URLROOT; ?>/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo URLROOT; ?>/js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="<?php echo URLROOT; ?>/js/popper.min.js"></script> -->
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <script src="https://twemoji.maxcdn.com/1/twemoji.min.js"></script>
	<script src="https://twemoji.maxcdn.com/twemoji.min.js"></script>
  <link href="<?php echo URLROOT; ?>/css/emoji.css" rel="stylesheet">
<?php
 date_default_timezone_set('UTC');
//logged in track, inactivity track

 ?>
 <script type="text/javascript">
   window.onbeforeunload = function(){
       var st = "0";
       $.ajax({
           type: "POST",
           url: "<?php echo URLROOT; ?>/users/onlineOfline/",
           data: {'st':st}
       });
   }
 </script>
  <title><?php echo SITENAME; ?></title>
</head>
<body class="fixed-sn black-skin">
<div class="container">
  <?php if(isset($_SESSION['user_id'])){
      require APPROOT . '/views/inc/navbar.php';
      if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        $online_status = 1;
        onlineOrOffline($online_status);
      }else {
        $online_status = 0;
        onlineOrOffline($online_status);
      }
    }
  ?>
