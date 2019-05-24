<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container">
  <div class="row justify-content-center mt-4">
      <form class="code mt-4" action="" method="post">
        <h4 class="">Please enter password reset code below</h4>
        <div class="row align-items-center mt-2">
          <div class="col">
        <input type="text" class="form-control" name="code" placeholder="###############################" required="" oninvalid="this.setCustomValidity('Please enter a password reset code')" oninput="setCustomValidity('')" >
          </div>
        </div>
        <span class="text-danger"><?php echo $data['code_err']; ?></span>
         <div class="row justify-content-start mt-2">
            <div class="col">
              <input type="submit" name="code" class="btn btn-primary btn-block mt-3" value="continue">
           </div>
          </div>
         <div class="text-center mt-2">
            <a class="text-danger" href="<?php echo URLROOT; ?>/users/recover">Cancel</a>
          </div>
      </form>
  </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>

 