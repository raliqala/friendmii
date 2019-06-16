<?php require APPROOT . '/views/inc/header.php'; ?>
  <style media="screen">
  .pac-container {
      z-index: 1051 !important;
  }
  </style>
  <div class="container">
    <?php foreach($data['profile'] as $pro) : ?>

    <div class="row">
      <div class="col-md-12">
        <h3 class="h5"><?php flash('profile_updated'); ?></h3>
        <h3 class="h5"><?php flash('error-profile'); ?></h3>
        <div class="jumbotron jumbotron-fluid jumbo-style" style="height: 13em;background-image:url('<?php if(isset($pro->cover_image)) {echo $pro->cover_image;} ?>'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: static;">
          <div class="container">
              <a href="#" class="d-flex justify-content-start"><i class="fa fa-camera" aria-hidden="true" data-toggle="modal" data-target="#modalSubscriptionForm1"></i></a>
          </div>
        </div>
        <div class="modal fade" id="modalSubscriptionForm1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Upload profile cover</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body mx-3">
                <section>
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-8 col-lg-8 col-xl-10">
                        <form class="" action="<?php echo URLROOT; ?>/profile/pro_cover/"  enctype="multipart/form-data" method="post">
                        <div class="row align-items-center">
                          <div class="col mt-4">
                            <input type="file" name="image" class="form-control" value="" placeholder="Select a pictute" required>
                          </div>
                        </div>
                        <div class="row justify-content-start mt-4">
                          <div class="col">
                            <button class="btn btn-primary btn-block mt-1 mb-4" data-disable-with="Updating data...">Update</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </section>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-image">
          <a href="#" class="d-flex justify-content-center camera-hover">
            <i class="fa fa-camera" aria-hidden="true" data-toggle="modal" data-target="#modalSubscriptionForm"></i>
          </a>
        <div class="inner-image">
          <?php if (!empty($pro->profile_pic)): ?>
            <img src='<?php echo $pro->profile_pic; ?>' class="rounded" alt='profile'>
          <?php else: ?>
            <img src="./public/assets/blank-profile.png" class="rounded" alt='profile'>
          <?php endif; ?>
        </div>
        <div class="modal fade" id="modalSubscriptionForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Upload profile picture</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body mx-3">
                <section>
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-8 col-lg-8 col-xl-10">
                        <form class="" action="<?php echo URLROOT; ?>/profile/pro_picture/"  enctype="multipart/form-data" method="post">
                        <div class="row align-items-center">
                          <div class="col mt-4">
                            <input type="file" name="image" class="form-control" value="" placeholder="Select a pictute" required>
                          </div>
                        </div>
                        <div class="row justify-content-start mt-4">
                          <div class="col">
                            <button class="btn btn-primary btn-block mt-1 mb-4" data-disable-with="Updating data...">Update</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </section>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="perso-data">
        <h2 class="h3"><?php echo $pro->firstname; ?> <span></span> <?php echo $pro->lastname; ?> <span class="text-success h6">Joined: <?php echo get_time_ago($pro->joined_date); ?></span></h2>
          <span><strong class="h5">Gender:</strong> <?php echo $pro->gender; ?></span>
          <span><strong class="h5 ml-2">Born:</strong> <?php echo $pro->dob; ?></span>
      </div>
      <div class="activity-starts">
        <!--write activity info posts likes crushes supercrushes ratings-->
        <div class="stats">
        	<div>
            	<strong>Posts</strong>
                0
            </div>
            <div>
            	<strong>Likes</strong>
                0
            </div>
            <div>
            	<strong>Super Crushes</strong>
                0
            </div>
               <div>
            	<strong>Crushes</strong>
                0
            </div>
               <div>
            	<strong>Rating</strong>
                0
            </div>
        </div>
      </div>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="account" role="tabpanel">
          <div class="contact-info-card">
            <!--write contact info.. email phone address-->
            <div class="contact-card-customize">
              <h1 class="h4">Contact information and Hobbies</h1>
              <span class="edit-contact pull-right"><a href="" data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo"><i class="fa fa-pencil-square fa-2x"></i></a></span>
              <hr>
              <div class="">
                <span><strong>Cell Number:</strong></span>
                <?php if (!empty($pro->cellno)): ?>
                  <p><?php echo $pro->cellno; ?></p>
                <?php else: ?>
                  <p><a href="#">Please insert your number</a></p>
                <?php endif; ?>
              </div>
              <div class="">
                <span><strong>Email:</strong></span>
                <p><?php echo $pro->email; ?></p>
              </div>
              <div class="">
                <span><strong>Address:</strong></span>
                <p><?php echo $pro->address; ?></p>
              </div>
              <div class="">
                <span><strong>Hobbies:</strong></span>
                <?php if (!empty($pro->hobby)): ?>
                  <p><?php echo $pro->hobby; ?></p>
                <?php else: ?>
                  <p>No hobbies?</p>
                <?php endif; ?>
              </div>
            </div>

            <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Update Personal information and hobby <br><span class="h6 text-primary">All fields are required exept Hobby</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <section>
                      <div class="container">
                        <div class="row justify-content-center">
                          <div class="col-12 col-md-8 col-lg-8 col-xl-10">
                            <form class="" action="<?php echo URLROOT; ?>/profile/edit/" method="post">
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <input type="text" name="firstname" class="form-control" maxlength="32" value="<?php if(isset($pro->job_name)) {echo $pro->firstname;} ?>" required>
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <input type="text" name="lastname" class="form-control" maxlength="32" value="<?php if(isset($pro->job_name)) {echo $pro->lastname;} ?>" required>
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <input type="email" name="email" class="form-control" maxlength="80" value="<?php if(isset($pro->email)) {echo $pro->email;} ?>" required>
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <select class="browser-default custom-select" name="gender" required>
                                  <option selected><?php if(isset($pro->gender)) {echo $pro->gender;} ?></option>
                                  <option value="Female">Female</option>
                                  <option value="Male">Male</option>
                                  <option value="Agender">Agender</option>
                                  <option value="Androgyne">Androgyne</option>
                                  <option value="Androgynous">Androgynous</option>
                                  <option value="Bigender">Bigender</option>
                                  <option value="Cis">Cis</option>
                                  <option value="Cisgender">Cisgender</option>
                                  <option value="Cis Female">Cis Female</option>
                                  <option value="Trans Female">Trans Female</option>
                                  <option value="Trans* Female">Trans* Female</option>
                                  <option value="Trans Male">Trans Male</option>
                                  <option value="Trans* Male">Trans* Male</option>
                                  <option value="Trans Man">Trans Man</option>
                                  <option value="Trans* Man">Trans* Man</option>
                                  <option value="Trans Person">Trans Person</option>
                                  <option value="Two-Spirit">Two-Spirit</option>
                                </select>
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <input type="text" name="hobby" class="form-control" maxlength="300" value="<?php if(isset($pro->hobby)) {echo $pro->hobby;} ?>" placeholder="hobby">
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <textarea name="address" id="autocomplete" class="form-control" onFocus="geolocate()" required><?php if(isset($pro->address)) {echo $pro->address;} ?></textarea>
                              </div>
                            </div>
                            <div class="row justify-content-start mt-4">
                              <div class="col">
                                <button class="btn btn-primary btn-block mt-1 mb-4" data-disable-with="Updating data...">Update</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="user-bio">
            <div class="profile card">
                <div class="profile-body">
                      <div class="">
                          <h1 class="h4">Bio</h1>
                          <?php if (!empty($pro->job_name)): ?>
                            <span><strong>Job:</strong> <?php echo $pro->job_name; ?></span>
                          <?php else: ?>
                            <span><strong>Job:</strong> job name</span>
                          <?php endif; ?>

                          <?php if (!empty($pro->job_title)): ?>
                            <span><strong>Position:</strong> <?php echo $pro->job_title; ?></span>
                          <?php else: ?>
                            <span><strong> Position:</strong> position name</span>
                          <?php endif; ?>
                          <span class="edit-contact pull-right"><a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil-square fa-2x"></i></a></span>
                          <hr>
                          <?php if (!empty($pro->bio)): ?>
                            <p><?php echo $pro->bio; ?></p>
                          <?php else: ?>
                            <h3>Your bio</h3>
                          <?php endif; ?>
                      </div>
              </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Update job, position and bio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <section>
                      <div class="container">
                        <div class="row justify-content-center">
                          <div class="col-12 col-md-8 col-lg-8 col-xl-10">
                            <form class="" action="<?php echo URLROOT; ?>/profile/update_bio/" method="post">
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <input type="text" name="job" class="form-control" value="<?php if(isset($pro->job_name)) {echo $pro->job_name;} ?>" placeholder="Job name">
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <input type="text" name="position" class="form-control" value="<?php if(isset($pro->job_title)) {echo $pro->job_title;} ?>" placeholder="Job position">
                              </div>
                            </div>
                            <div class="row align-items-center">
                              <div class="col mt-4">
                                <textarea name="bio" class="form-control" maxlength="500" placeholder="Your bio here.."><?php if(isset($pro->bio)) {echo $pro->bio;} ?></textarea>
                              </div>
                            </div>
                            <div class="row justify-content-start mt-4">
                              <div class="col">
                                <button class="btn btn-primary btn-block mt-1 mb-4" data-disable-with="Updating data...">Update</button>
                              </div>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                  aria-selected="true">Posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                  aria-selected="false">Liked posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                  aria-selected="false">Saved posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="bookmarks-tab" data-toggle="tab" href="#bookmark" role="tab" aria-controls="bookmark"
                  aria-selected="false">bookmarks</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">three</div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">one</div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">two</div>
              <div class="tab-pane fade" id="bookmark" role="tabpanel" aria-labelledby="contact-tab">four</div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="favourite" role="tabpanel">
          <div class="content-wraper-out-favourite">
            <div class="content-wraper-inside">
              <h1 class="h4">My favourite stuff</h1>
              <span class="edit-contact pull-right"><a href="" data-toggle="modal" data-target="#orangeModalSubscription"><i class="fa fa-pencil-square fa-2x"></i></a></span>
              <div class="modal fade" id="orangeModalSubscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog modal-notify" role="document">
                    <!--Content-->
                    <div class="modal-content">
                      <!--Header-->
                      <div class="modal-header text-center">
                        <h4 class="modal-title black-text w-100 font-weight-bold py-2">Update favourites</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" class="text-danager">&times;</span>
                        </button>
                      </div>

                      <!--Body-->
                      <section>
                        <div class="container">
                          <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-10">
                              <form class="" action="<?php echo URLROOT; ?>/profile/favourite/<?php echo $data['id']; ?>" method="post">
                              <div class="row align-items-center">
                                <div class="col mt-4">
                                  <input type="text" name="music" class="form-control" value="<?php if(isset($pro->music)) {echo $pro->music;} ?>" placeholder="Music">
                                </div>
                              </div>
                              <div class="row align-items-center mt-4">
                                <div class="col">
                                  <input type="text" name="movies" class="form-control" value="<?php if(isset($pro->movies)) {echo $pro->movies;} ?>" placeholder="Movies">
                                </div>
                              </div>
                              <div class="row align-items-center mt-4">
                                <div class="col">
                                  <input type="text" name="books" class="form-control" value="<?php if(isset($pro->books)) {echo $pro->books;} ?>" placeholder="Books">
                                </div>
                              </div>
                              <div class="row align-items-center mt-4">
                                <div class="col">
                                  <input type="text" name="animals" class="form-control" value="<?php if(isset($pro->animals)) {echo $pro->animals;} ?>" placeholder="Animals">
                                </div>
                              </div>
                              <div class="row justify-content-start mt-4">
                                <div class="col">
                                  <button class="btn btn-primary btn-block mt-1 mb-4" data-disable-with="Updating data...">Update</button>
                                </div>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </section>


                    </div>
                    <!--/.Content-->
                  </div>
                </div>
                  <hr>
                  <div class="card card-cascade">
                    <!-- Card image -->
                    <div class="view view-cascade back-image">
                      <div class="view view-cascade Darkened-back">
                        <h4 class="font-weight-bold card-title text-center text-white mt-4">Music</h4>
                      </div>
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                      <?php if (!empty($pro->music)): ?>
                        <h5 class="pink-text pb-2 pt-1"><?php echo $pro->music; ?></h5>
                      <?php else: ?>
                        <h5 class="pink-text pb-2 pt-1">What is your favourite music</h5>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="card card-cascade">
                    <!-- Card image -->
                    <div class="view view-cascade back-image-movie">
                      <div class="view view-cascade Darkened-back">
                        <h4 class="font-weight-bold card-title text-center text-white mt-4">Movies</h4>
                      </div>
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                      <?php if (!empty($pro->movies)): ?>
                        <h5 class="pink-text pb-2 pt-1"><?php echo $pro->movies; ?></h5>
                      <?php else: ?>
                        <h5 class="pink-text pb-2 pt-1">What are your favourite movies</h5>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="card card-cascade">
                    <!-- Card image -->
                    <div class="view view-cascade back-image-animal">
                      <div class="view view-cascade Darkened-back">
                        <h4 class="font-weight-bold card-title text-center text-white mt-4">Animals</h4>
                      </div>
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                      <?php if (!empty($pro->animals)): ?>
                        <h5 class="pink-text pb-2 pt-1"><?php echo $pro->animals; ?></h5>
                      <?php else: ?>
                        <h5 class="pink-text pb-2 pt-1">What are your favourite animals</h5>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="card card-cascade">
                    <!-- Card image -->
                    <div class="view view-cascade back-image-book">
                      <div class="view view-cascade Darkened-back">
                        <h4 class="font-weight-bold card-title text-center text-white mt-4">Books</h4>
                      </div>
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                      <?php if (!empty($pro->books)): ?>
                        <h5 class="pink-text pb-2 pt-1"><?php echo $pro->books; ?></h5>
                      <?php else: ?>
                        <h5 class="pink-text pb-2 pt-1">What are your favourite books</h5>
                      <?php endif; ?>
                    </div>
                  </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="privacy" role="tabpanel">
          <div class="content-wraper-out-privacy">
            <div class="content-wraper-inside">
              <h1 class="h4">Privacy and safety</h1>
              <span class="edit-contact pull-right"><a href="#"><i class="fa fa-pencil-square fa-2x"></i></a></span>
              <hr>
              <div class="privacy-content">

              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="security" role="tabpanel">
          <div class="content-wraper-out-security">
            <div class="content-wraper-inside">
              <h1 class="h4">Security</h1>
              <span class="edit-contact pull-right"><a href="#"><i class="fa fa-pencil-square fa-2x"></i></a></span>
              <hr>
              <div class="security-content">

              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="manage" role="tabpanel">
          <div class="content-wraper-out-manage">
            <div class="content-wraper-inside">
              <h1 class="h4">Manage posts</h1>
              <span class="edit-contact pull-right"><a href="#"><i class="fa fa-pencil-square fa-2x"></i></a></span>
              <hr>
              <div class="manage-content">

              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="friends" role="tabpanel">
          <div class="content-wraper-out-friends">
            <div class="content-wraper-inside">
              <h1 class="h4">Friends and Best friends</h1>
              <span class="edit-contact pull-right"><a href="#"><i class="fa fa-pencil-square fa-2x"></i></a></span>
              <hr>
              <div class="friends-content">

              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="match" role="tabpanel">
          <div class="content-wraper-out-friends">
            <div class="content-wraper-inside">
              <h1 class="h4">Find Match</h1>
              <span class="edit-contact pull-right"><a href="#"><i class="fa fa-pencil-square fa-2x"></i></a></span>
              <hr>
              <div class="friends-content">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="pull-right left-controller-option">
        <div class="card-size-resize">
          <!--col-md-3 col-xl-3-->
           <div class="card">
               <div class="card-header">
                   <h5 class="card-title mb-0">Information</h5>
               </div>

               <div class="list-group list-group-flush" role="tablist">
                   <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
                     Default
                   </a>
                   <a class="list-group-item list-group-item-action" data-toggle="list" href="#friends" role="tab">
                     Friends(257) Best friends(54)
                   </a>
                   <a class="list-group-item list-group-item-action" data-toggle="list" href="#favourite" role="tab">
                     Favourite
                   </a>
                   <a class="list-group-item list-group-item-action" data-toggle="list" href="#match" role="tab">
                     Find Match
                   </a>
                   <a class="list-group-item list-group-item-action" data-toggle="list" href="#privacy" role="tab">
                     Privacy and safety
                   </a>
                   <a class="list-group-item list-group-item-action" data-toggle="list" href="#security" role="tab">
                     Security
                   </a>
                   <a class="list-group-item list-group-item-action" data-toggle="list" href="#manage" role="tab">
                     Manage activies
                   </a>
               </div>
            </div>
          </div>
        </div>
        <div class="">

      </div>
    </div>
    <?php endforeach; ?>
  </div>

<div class="" style="margin-bottom: 5em;">

</div>
<script>
var placeSearch, autocomplete;

  var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
  };

  function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
     document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
  }

  function fillInAddress() {
  // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
     document.getElementById(component).value = '';
     document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details,
    // and then fill-in the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
     var addressType = place.address_components[i].types[0];
     if (componentForm[addressType]) {
       var val = place.address_components[i][componentForm[addressType]];
       document.getElementById(addressType).value = val;
     }
    }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
    if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(function(position) {
       var geolocation = {
         lat: position.coords.latitude,
         lng: position.coords.longitude
       };
       var circle = new google.maps.Circle(
           {center: geolocation, radius: position.coords.accuracy});
       autocomplete.setBounds(circle.getBounds());
     });
    }
  }

 </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRMLF9pK8EoY-wOnp1_N1uZ7pH6fOnlLQ&libraries=places&callback=initAutocomplete"
     async defer></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
