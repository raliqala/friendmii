<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light mt-5"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
      <div class="card card-body bg-light mt-5">
        <h2>Edit Post</h2>
        <p>When editing post with image re-upload the image</p>
        <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" enctype="multipart/form-data" method="post">
          <div class="form-group">
              <label>Post:</label>
              <textarea name="post_text" class="form-control form-control-lg"><?php echo $data['post']; ?></textarea>
              <span class="invalid-feedback"><?php echo $data['post_text_err']; ?></span>
          </div>
          <div class="form-group">
              <label>Image:</label>
              <input type="file" name="image" class="form-control form-control-lg" accept=".jpg, .png, .gif, .jpeg" value="<?php echo $data['image']; ?>">
          </div>
          <input type="submit" class="btn btn-success" value="Submit">
        </form>
      </div>



<?php require APPROOT . '/views/inc/footer.php'; ?>
