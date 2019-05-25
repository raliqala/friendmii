
<header>
    <div class="logo">
      <a href="<?php echo URLROOT; ?>">
        <img src="./public/assets/friendmii-logo transparent.png" alt="logo">
      </a>
    </div>
    <div class="hamberger">
      <a href="">
        <i class="fa fa-bars" aria-hidden="true"></i>
      </a>
    </div>
    <div class="profile">
      <a href="<?php echo URLROOT; ?>/profile">
        <img src='./public/assets/blank-profile.png' alt='profile'>
      </a>
    </div>
    <input type="checkbox" name="" id="nav-toggle" class="nav-toggle">
  <nav>
        <ul>
          <li><a href="<?php echo URLROOT; ?>"><i class="fa fa-home right-side" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-question-circle right-side" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-envelope right-side" aria-hidden="true"></i></a></li>
          <li><a href="" class="find-match">FM</a></li>
          <li><a href=""><i class="fa fa-bell left-side" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-user left-side" aria-hidden="true"></i></a></li>
          <li><a href=""><i class="fa fa-heart left-side" aria-hidden="true"></i></a></li>
        </ul>
  </nav>
    <label for="nav-toggle" class="nav-toggle-label">
          <span></span>
    </label>

    <div class="search-form-out">
      <form class="form-search-nav" action="" method="get">
        <input type="text" class="nav-search-input" name="search" placeholder="Search...">
        <button type="submit" class="button-search"><i class="fa fa-search" aria-hidden="true"></i></button>
      </form>
  </div>
    <div class="dropdown show three_dot_menue">
      <a class="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">
        <img src="./public/assets/menue.png" alt="logo">
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">Signed in as <strong><?php echo $_SESSION['name'];?></strong></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Change theme</a>
          <a class="dropdown-item" href="#">Terms</a>
          <a class="dropdown-item" href="#">Privacy policy</a>
          <a class="dropdown-item" href="#">Report a problem</a>
          <a class="dropdown-item" href="#">Setting</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-center" href="<?php echo URLROOT; ?>/users/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Signout</a>
      </div>
    </div>
</header>
