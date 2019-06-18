<?php require APPROOT . '/views/inc/header.php'; ?>

  <div class="container">
    <div class="row">
      <div class="" role="alert" style="position: relative; bottom: -2em; right: -7em; font-size: 1em;">
        <?php flash('error-post'); ?>
      </div>
    </div>
    <!-- <div class="row pull-left ml-auto">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="./public/assets/default-fav.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div>
    <div class="row pull-right mr-auto">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="./public/assets/default-fav.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div> -->
      <section class="post-only">
        <div class="container">
          <div class="row justify-content-center">
            <div class="outer-positioning">
              <div class="row align-items-center">
                <div class="post-profile">
                  <a href="<?php echo URLROOT; ?>/profile">
                    <?php if (!empty($_SESSION['profile_pic'])): ?>
                      <img src="<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                    <?php else: ?>
                      <img src="./public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                    <?php endif; ?>
                  </a>
                </div>
                <div class="col mt-4">
                  <input type="text" class="form-control-custom" name="" data-toggle="modal" data-target="#modalPostForm" data-emojiable="true" data-emoji-input="unicode" placeholder="Have something in mind...">
                </div>
                <div class="post-camera">
                  <a href="" data-toggle="modal" data-target="#modalPostForm"><i class="fa fa-camera"></i></a>
                </div>
              </div>

              <div class="modal fade" id="modalPostForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                    <div class="modal-header text-center">
                      <h4 class="modal-title w-100 font-weight-bold" style="font-style: italic; color: #2AD1A3 !important;"><?php echo $_SESSION['name']?></h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body mx-3">
                      <section>
                        <div class="container">
                          <div class="row justify-content-center">
                            <div class="col-12 col-md-8 col-lg-8 col-xl-10">
                              <form class="" form="postForm" action="<?php echo URLROOT; ?>/posts/post/" onsubmit="return TpValidate()" enctype="multipart/form-data" method="post">
                              <div class="row align-items-center">
                                 <div class="post-post">
                                  <a href="<?php echo URLROOT; ?>/profile">
                                    <?php if (!empty($_SESSION['profile_pic'])): ?>
                                      <img src="<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                                    <?php else: ?>
                                      <img src="./public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                                    <?php endif; ?>
                                  </a>
                                </div>
                                <div class="col mt-4">
                                  <textarea name="post_text" id="area" style="resize: none; " class="form-control form-control-lg" maxlength="500" data-emojiable="true" data-emoji-input="unicode" placeholder="Say something here.."></textarea>
                                </div>
                                <div class="file-field" style="position: absolute; top: 5.69em; left: 35.49em;">
                                  <div class="d-flex justify-content-left">
                                    <div class="">
                                      <span class="blue-text"><i class="fa fa-picture-o fa-lg"></i></span>
                                      <input type="file" id="file" name="image" accept=".jpg, .png, .gif, .jpeg" onkeyup="imageVal()">
                                    </div>
                                  </div>
                                </div>
                              </div>
                                <div class="row justify-content-start mt-4">
                                  <div class="col">
                                    <button class="btn btn-primary btn-block mt-1 mb-4">Post</button>
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
            </div>
          </div>
        </section>

        <div class="mt-4">
        </div>

        <?php foreach($data['posts'] as $post) :?>
          <section>
            <div class="container">
              <div class="row justify-content-center mr-4">
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                  <div class="card card-body mb-3">
                      <h4 class="card-title"></h4>
                      <div class="mb-3 image-user" style="margin-top: -1em;">
                        <a href="<?php echo URLROOT; ?>/profile">
                          <?php if (!empty($post->profile_pic)): ?>
                            <img src="<?php echo $post->profile_pic; ?>" width="40" height="40" alt="profile pic">
                          <?php else: ?>
                            <img src="./public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                          <?php endif; ?>
                        </a>
                        <a href="" class="name-time-position"><?php echo $post->firstname; ?></a><br>
                        <a href="" class="time-position"><?php echo get_time_ago($post->posted_at); ?></a>

                        <a href="#" class="a-move pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h fa-lg"></i></a>
                        <div class="dropdown-menu">
                          <?php if ($_SESSION['user_id'] != $post->user_id): ?>
                            <a class="dropdown-item" href="#"><i class="fa fa-bug"></i> Report post</a>
                          <?php else: ?>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->post_id;?>"><i class="fa fa-pencil"></i> Edit post</a>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->post_id;?>"><i class="fa fa-trash"></i> Delete post</a>
                          <?php endif; ?>

                        </div>
                        <!-- Basic dropdown -->
                        <span class="pull-right">
                          <a href="" class="mr-4">
                            <i class="fa fa-bookmark fa-lg" aria-hidden="true"></i>
                          </a>
                          <a href="#">
                            <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                          </a>
                        </span>
                      </div>
                      <p class="card-text">
                          <?php echo $post->post; ?>
                      </p>
                      <div class="feed-body">
                       <?php if (!empty($post->post_image && $post->post_image != "assets/posts/")): ?>
                         <div class="post-image-style">
                           <img src="<?php echo $post->post_image; ?>" width="623" height="300" alt="post image">
                         </div>
                       <?php endif; ?>
                     </div>

                  </div>
              </div>
            </div>
          </div>
        </section>
        <?php endforeach; ?>

    </div>
    <script type="text/javascript">


          function TpValidate(){
            var fileInput = document.getElementById('file');
            var post = document.getElementById('area');
            var postData = post.value;
            var image = fileInput.value;

            if (postData == "" && image == "")
            {
                alert("Please write something...");
                fileInput.value = '';
                return false;
                post.value = '';
                return false;
            }

            return true;
        }

        function imageVal(){
          var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
           if(!allowedExtensions.exec(image)){
               alert('Please upload file having extensions .jpeg/.jpg/.png/.gif only.');
               fileInput.value = '';
               return false;
           }
          var fileSize = document.getElementById('file').files[0].size;
          if(fileSize > 2097152){
             alert("Maximum file size exceeded, file size must be less than or equals 2mb");
             fileInput.value = '';
             return false;
          };
        }

    </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
