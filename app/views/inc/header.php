<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="apple-touch-icon" sizes="57x57" href="./public/assets/favourcon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./public/assets/favourcon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./public/assets/favourcon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./public/assets/favourcon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./public/assets/favourcon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./public/assets/favourcon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./public/assets/favourcon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./public/assets/favourcon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./public/assets/favourcon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="./public/assets/favourcon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./public/assets/favourcon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./public/assets/favourcon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./public/assets/favourcon/favicon-16x16.png">
  <link rel="manifest" href="./public/assets/favourcon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="./public/assets/favourcon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/font-awesome.css">
  <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <script src="<?php echo URLROOT; ?>/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
  <link href="<?php echo URLROOT; ?>/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
  <title><?php echo SITENAME; ?></title>
</head>
<body>

  <?php if(isset($_SESSION['user_id'])) { require APPROOT . '/views/inc/navbar.php';}  ?>
  <div class="container">
