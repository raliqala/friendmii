<?php require APPROOT . '/views/inc/header.php'; ?>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-3"><?php echo $data['title']; ?></h1>
      <p class="lead"><?php echo $data['description']; ?></p>
    </div>
  </div>
  <p><?php flash('email_recov_sent'); ?></p>
<?php require APPROOT . '/views/inc/footer.php'; ?>
