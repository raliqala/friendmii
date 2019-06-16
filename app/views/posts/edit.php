<?php require APPROOT . '/views/inc/header.php'; ?>
<a href="<?php echo URLROOT; ?>" class="btn btn-light"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
      <div class="card card-body bg-light mt-5">
        <h2>Edit Post</h2>
        <p>Change the details of this post</p>
        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
          <div class="form-group">
              <label>Title:<sup>*</sup></label>
              <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
              <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
          </div>
          <div class="form-group">
              <label>Body:<sup>*</sup></label>
              <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
              <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
          </div>
          <input type="submit" class="btn btn-success" value="Submit">
        </form>
      </div>

      <div class="modal fade modalPost" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <section>
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-12 col-md-8 col-lg-8 col-xl-10">
                    <form id="fupForm" name="form1" enctype="multipart/form-data" method="post">
                    <div class="row align-items-center">
                       <div class="post-post">
                        <a href="">
                          <img src="<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                        </a>
                      </div>
                      <div class="col mt-4">
                        <textarea name="post_text" style="resize: none;" class="form-control form-control-lg" id="post_text" maxlength="500" placeholder="Say something here.."></textarea>
                      </div>
                      <!-- <div class="file-field" style="margin-left: -3em; margin-bottom: -5.5em;">
                        <div class="d-flex justify-content-left">
                          <div class="">
                          data-toggle="modal" data-target=".modalPost"
                            <span><i class="fa fa-picture-o fa-lg"></i></span>
                            <input type="file" name="image">
                          </div>
                        </div>
                      </div> -->
                    </div>
                      <div class="row justify-content-start mt-4">
                        <div class="col">
                          <button class="btn btn-primary btn-block mt-1 mb-4" id="post" data-disable-with="Posting...">Post</button>
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
<?php require APPROOT . '/views/inc/footer.php'; ?>
