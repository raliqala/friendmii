<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron jumbotron-fluid">
    
      <h1 class="display-3 text-center"><?php echo $data['title']; ?></h1>
      <h3 class="display-5 text-center"><?php echo $data['description']; ?></h3>
      <h5 class="display-5 text-center"><?php flash('register_success'); ?></h5>
      <p class="lead text-center"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
  <hr>
  <p class="lead text-center">
    <a class="btn btn-primary btn-sm" href="https://google.com/" role="button">Continue to your email address</a>
  </p>
  
    <input type="hidden" name="code" value="<?php $data['ress']; ?>">
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
