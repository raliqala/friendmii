<?php require APPROOT . '/views/inc/header.php'; ?>


<section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6">
          <div class="row">
             <h5 class="col text-center mt-3"><?php flash('error'); ?></h5>
          </div>
          <div class="row">
            <div class="col text-center">
              <h1>RECOVER YOUR PASSWORD</h1>
              <p class="text-h3">Far far away, far from the countries Vokalia and Consonantia. </p>
            </div>
          </div>
          <form action="<?php echo URLROOT; ?>/users/recover" method="post">
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="E-mail" >
            <input type="hidden" class="hide" name="token" value="<?php echo validation_token(); ?>">
            </div>
          </div>
          <span class="text-danger"><?php echo $data['email_err'] ?></span>
          <div class="row justify-content-start mt-3">
            <div class="col">
              <button type="submit" class="btn btn-primary btn-block mt-3" >Send password reset code</button>
            </div>
          </div>
          <p class="text-center mt-2"><a class="text-danger" href="<?php echo URLROOT; ?>/users/login">Cancel</a></p>
         </form>
        </div>
      </div>
    </div>
  </section>

  
<?php require APPROOT . '/views/inc/footer.php'; ?>
