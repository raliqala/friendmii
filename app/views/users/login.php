<?php require APPROOT . '/views/inc/header.php'; ?>


<section style="padding-top: 2em; ">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 col-xl-5 ml-auto">
           <div class="row">
             <div class="text-center">
              <h5 class="col text-center mt-3"><?php flash('pass_updated'); ?></h5>
              <h5 class="text-center mt-3"><?php flash('account_activated'); ?></h5>
             </div>
          </div>
          <div class="row">
            <div class="col text-center">
              <h1>SIGN IN</h1>
              <p class="text-h3">Far far away, far from the countries Vokalia and Consonantia. </p>
            </div>
          </div>
          <form action="<?php echo URLROOT; ?>/users/login" method="post">
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="email" name="email" class="form-control" id="email" value="<?php if(isset($_COOKIE['friendmii_ue'])) {echo $_COOKIE['friendmii_ue'];} ?>" placeholder="E-mail" >
            </div>
          </div>
          <span class="text-danger"><?php echo $data['email_err'] ?></span>
          <div class="row align-items-center mt-2">
            <div class="col">
            <input type="password" name="password" class="form-control" id="password" value="<?php if(isset($_COOKIE['friendmii_up'])) {echo $_COOKIE['friendmii_up'];} ?>" placeholder="Password">
            </div>
          </div>
          <span class="text-danger"><?php echo $data['password_err'] ?></span>
          <div class="row justify-content-start mt-3">
            <div class="col">
              <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" name="remember" <?php if(isset($_COOKIE['friendmii_ue'])){?> checked <?php } ?> value="on" class="form-check-input">
                  Remember me
                </label>
                <a href="<?php echo URLROOT; ?>/users/recover" class="pull-right">Forgot Password?</a>
              </div>
              <button type="submit" id="submit-control" class="btn btn-primary btn-block mt-3" data-disable-with="Signing in...">SIGNIN</button>
            </div>
          </div>
          <p class="text-center mt-2">Don't have an Account? <a href="<?php echo URLROOT; ?>/users/register">SIGN UP</a></p>
         </form>
        </div>
      </div>
    </div>
  </section>

<?php require APPROOT . '/views/inc/footer.php'; ?>
