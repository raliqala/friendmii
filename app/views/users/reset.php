<?php require APPROOT . '/views/inc/header.php'; ?>


<section>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-6">
          <div class="row">
             <h5 class="col text-center mt-3"><?php flash('reset_pass'); ?></h5>
          </div>
          <div class="row">
            <div class="col text-center">
              <h3>PLEASE RESET YOUR PASSWORD IN THE FORM BELOW</h3>
              <!--<p class="text-h3">Far far away, far from the countries Vokalia and Consonantia. </p>-->
            </div>
          </div>
          <form action="" method="post">
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="password" name="password" class="form-control" value="" placeholder="New Password" >
            </div>
          </div>
          <span class="text-danger"><?php echo $data['password_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="password" name="confirm_password" class="form-control" value="" placeholder="Confirm new password">
            </div>
            <input type="hidden" class="hide" name="token" value="<?php echo validation_token(); ?>">
          </div>
          <span class="text-danger"><?php echo $data['confirm_password_err'] ?></span>
          <div class="row justify-content-start mt-3">
            <div class="col">
              <button type="submit" class="btn btn-primary btn-block mt-3" >RESET</button>
            </div>
          </div>
          <p class="text-center mt-2"><a class="text-danger" href="<?php echo URLROOT; ?>/users/login">Cancel</a></p>
         </form>
        </div>
      </div>
    </div>
  </section>
      
<?php require APPROOT . '/views/inc/footer.php'; ?>