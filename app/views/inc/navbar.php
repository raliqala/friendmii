<link href="<?php echo URLROOT; ?>/css/mdb.min.css" rel="stylesheet">

<!-- Sidebar navigation -->
   <!-- <div id="slide-out" class="side-nav sn-bg-4 fixed">
     <ul class="custom-scrollbar"> -->
       <!-- Logo -->
       <!-- <li>
         <div class="logo-wrapper waves-light">
           <a href="#"><img src="./public/assets/friendmii-logo transparent.png" class="img-fluid flex-center"></a>
         </div>
       </li> -->
       <!--/. Logo -->
       <!--Social-->
       <!-- <li>
         <ul class="social">
           <li><a href="#" class="icons-sm fb-ic">name</a></li>
         </ul>
       </li> -->
       <!--/Social-->
       <!--Search Form-->
       <!-- <li>
         <form class="search-form" role="search">
           <div class="form-group md-form mt-0 pt-1 waves-light">
             <input type="text" class="form-control" placeholder="Search">
           </div>
         </form>
       </li> -->
       <!--/.Search Form-->
       <!-- Side navigation links -->
       <!-- <li>
         <ul class="collapsible collapsible-accordion">
           <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-chevron-right"></i> Submit blog<i
                 class="fa fa-angle-down rotate-icon"></i></a>
             <div class="collapsible-body">
               <ul class="list-unstyled">
                 <li><a href="#" class="waves-effect">Submit listing</a>
                 </li>
                 <li><a href="#" class="waves-effect">Registration form</a>
                 </li>
               </ul>
             </div>
           </li>

           <li>
             <div class="">
               <ul class="list-unstyled">
                 <li><a href="#" class="waves-effect">Introduction</a>
                 </li>
                 <li><a href="#" class="waves-effect">Monthly meetings</a>
                 </li>
               </ul>
             </div>
           </li>
           <li>
             <div class="">
               <ul class="list-unstyled">
                 <li><a href="#" class="waves-effect">Introduction</a>
                 </li>
                 <li><a href="#" class="waves-effect">Monthly meetings</a>
                 </li>
               </ul>
             </div>
           </li>
           <li>
             <div class="">
               <ul class="list-unstyled">
                 <li><a href="#" class="waves-effect">Introduction</a>
                 </li>
                 <li><a href="#" class="waves-effect">Monthly meetings</a>
                 </li>
               </ul>
             </div>
           </li>
         </ul>
       </li> -->
       <!--/. Side navigation links -->
     <!-- </ul>
     <div class="sidenav-bg mask-strong"></div>
   </div> -->
   <!--/. Sidebar navigation -->
<!--Navbar -->
<nav class="mb-4 navbar fixed-top navbar-expand-lg navbar-dark default-color">
  <!-- Navbar brand -->

   <a class="navbar-brand" href="#">FriendMii</a>


   <!-- Collapse button -->
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
     aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>

   <!-- Collapsible content -->
   <div class="collapse navbar-collapse" id="basicExampleNav">
 <!-- <a href="#" data-activates="slide-out" class="button-collapse white-text"><i class="fa fa-bars"></i></a> -->
     <!-- Links -->
     <ul class="navbar-nav mr-auto mx-auto custom-links">
       <li class="nav-item ">
         <a class="nav-link" href="<?php echo URLROOT; ?>"> <i class="fa fa-home"></i>
           <span class="sr-only">(current)</span>
         </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="<?php echo URLROOT; ?>/pages/help"><i class="fa fa-question-circle" aria-hidden="true"></i> </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#"><i class="fa fa-envelope" aria-hidden="true"></i> </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#">FM</a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#"><i class="fa fa-bell" aria-hidden="true"></i> </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i>  </a>
       </li>
       <li class="nav-item">
         <a class="nav-link" href="#"><i class="fa fa-heart" aria-hidden="true"></i>  </a>
       </li>

       <!-- Dropdown -->

     <!-- Links -->

       <form class="form-inline my-2 my-lg-0 ml-4">
         <input class="form-control" style="line-height: 1.4;" name="search" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
         <button class="mr-4" style="background: transparent; border: none; margin-left: -2em; color: #828688;"><i class="fa fa-search"></i></button>
       </form>
     </ul>
   </div>
   <!-- Collapsible content -->
   <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item">
        <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $_SESSION['username']; ?>" class="nav-link waves-effect waves-light">
          <?php echo $_SESSION['name']; ?>
        </a>
      </li>
      <li class="nav-item avatar dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
            <?php if (!empty($_SESSION['profile_pic'])): ?>
              <img src='<?php echo URLROOT; ?>/<?php echo $_SESSION['profile_pic']; ?>' class="rounded-circle z-depth-0" alt='profile'>
            <?php else: ?>
              <img src="./public/assets/blank-profile.png" width="40" height="40" class="img-circle img-responsive" alt='profile'>
            <?php endif; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-left dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-55">
          <a class="dropdown-item" href="<?php echo URLROOT; ?>/profile?u=<?php echo $_SESSION['username']; ?>">Signed in as <strong><?php echo $_SESSION['name'];?></strong></a>
          <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Change theme</a>
            <a class="dropdown-item" href="#"><i class="fa fa-info-circle" aria-hidden="true"></i> Terms</a>
            <a class="dropdown-item" href="#"><i class="fa fa-lock" aria-hidden="true"></i> <span> </span> Privacy policy</a>
            <a class="dropdown-item" href="#"><i class="fa fa-bug" aria-hidden="true"></i> <span> </span> Report a problem</a>
            <a class="dropdown-item" href="<?php echo URLROOT; ?>/settings"><i class="fa fa-cog" aria-hidden="true"></i> <span> </span> Setting</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-center" href="<?php echo URLROOT; ?>/users/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Signout</a>
        </div>
      </li>
    </ul>
 </nav>
 <!--/.Navbar-->
<!--/.Navbar -->
 <!-- <script type="text/javascript">
  $(document).ready(function(){
    $("#country").keyup(function(){
      var query = $(this).val();
      if (query != "") {
        $.ajax({
                url: '/posts/search',
                method: 'POST',
                data: {query:query},
                success: function(data)
                {
                  $('#results').html(data);
                  $('#results').css('display', 'block');
                    $("#country").focusout(function(){
                        $('#results').css('display', 'none');
                    });
                    $("#country").focusin(function(){
                        $('#results').css('display', 'block');
                    });
                }
        });
      } else {
             $('#results').css('display', 'none');
      }
    });
  });
</script> -->
