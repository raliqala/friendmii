<?php require APPROOT . '/views/inc/header.php'; ?>

  <div class="container">
    <div class="row">
      <h3 class="h5"><?php flash('error-post'); ?></h3>
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
                                      <input type="file" id="file" name="image" accept=".jpg, .png, .gif, .jpeg">
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

            return true;
        }

    </script>
<?php require APPROOT . '/views/inc/footer.php'; ?>
