<?php require APPROOT . '/views/inc/header.php'; ?>
<script src="https://kit.fontawesome.com/1b5939c109.js"></script>
  <div class="container">
    <div class="row justify-content-center">
      <div class="" role="alert" style="position: relative; bottom: -2em; left: -1em; font-size: 1em;">
        <?php flash('error-post'); ?>
        <?php flash('report_message'); ?>

      </div>
    </div>
    <!-- <div class="row pull-left ml-auto">
      <div class="card" style="width: 17rem; position: absolute; left: em;">
        <img class="card-img-top" src="./public/assets/default-fav.jpg" alt="Card image cap">
        <div class="card-body">
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        </div>
      </div>
    </div>
    <div class="row pull-right mr-auto">
      <div class="card" style="width: 17rem; position: absolute; right: 4em;">
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
                  <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $_SESSION['username']; ?>">
                    <?php if (!empty($_SESSION['profile_pic'])): ?>
                      <img src="<?php echo URLROOT;?>/<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                    <?php else: ?>
                      <img src="<?php echo URLROOT;?>/public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
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
                                  <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $_SESSION['username']; ?>">
                                    <?php if (!empty($_SESSION['profile_pic'])): ?>
                                      <img src="<?php echo URLROOT;?>/<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                                    <?php else: ?>
                                      <img src="./public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                                    <?php endif; ?>
                                  </a>
                                </div>
                                <div class="col mt-4">
                                  <textarea name="post_text" dir="auto" id="area" style="resize: none; " class="form-control form-control-lg" maxlength="500" data-emojiable="true" data-emoji-input="unicode" placeholder="Say something here.."></textarea>
                                  <img src="" height="" width="" onClick="triggerClick()" id="filepreview" style="position: relative; top: .5em; left: 1em; width: auto; height: auto; max-height: 140px; max-width: 140px; border-radius: 5px;">
                                </div>
                                <!-- <div class="col mt-4">
                                  <select class="browser-default" name="privacy" required>
                                    <option value="0" selected>Public</option>
                                    <option value="1">Friends</option>
                                    <option value="2">Best Friends</option>
                                  </select>
                                </div> -->
                                <div class="file-field" style="position: absolute; top: 4.8em; left: 34.5em;">
                                  <div class="d-flex justify-content-left">
                                    <div class="">
                                      <span class="blue-text"><i class="fa fa-picture-o fa-lg"></i></span>
                                      <input type="file" onChange="previewImage(this)" id="file" name="image" accept=".jpg, .png, .gif, .jpeg" onkeyup="imageVal()">
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
          <section class="display_posts_only">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-12 col-xl-7">
                  <div class="card card-body mb-3">
                      <h4 class="card-title"></h4>
                      <div class="mb-3 image-user" style="margin-top: -1em;">
                        <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $post->username; ?>">
                          <?php if (!empty($post->profile_pic)): ?>
                            <img src="<?php echo URLROOT;?>/<?php echo $post->profile_pic; ?>" width="40" height="40" alt="profile pic">
                          <?php else: ?>
                            <img src="<?php echo URLROOT;?>/public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                          <?php endif; ?>
                        </a>
                        <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $post->username; ?>" class="name-position"><?php echo $post->firstname; ?> <span style="color: gray; font-size: 12px;"> | @<?php echo $post->username; ?></span></a><br>
                        <a href="" class="time-position"><?php echo get_time_ago($post->posted_at); ?></a>

                        <a href="javascript:void(0)" class="a-move pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h fa-lg"></i></a>
                        <div class="dropdown-menu">
                          <?php if ($_SESSION['user_id'] != $post->user_id): ?>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#reportPostModal<?php echo $post->post_id;?>">
                              <i class="fa fa-bug"></i> Report post
                            </a>
                          <?php else: ?>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->post_id;?>" data-toggle="modal" data-target="#editModal<?php echo $post->post_id;?>">
                              <i class="fa fa-pencil"></i> Edit post
                            </a>
                            <a class="dropdown-item" href="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->post_id;?>" data-toggle="modal" data-target="#deleteModal<?php echo $post->post_id;?>">
                              <i class="fa fa-trash" aria-hidden='true'></i> Delete post
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#reportPostModal<?php echo $post->post_id;?>">
                              <i class="fa fa-bug"></i> Report post
                            </a>
                          <?php endif; ?>
                        </div>
                        <!--Report Post-->
                            <div class="modal fade" id="reportPostModal<?php echo $post->post_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-bug"></i> Reort this post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form class="" action="<?php echo URLROOT; ?>/posts/reportPost/<?php echo $post->post_id;?>" method="post">
                                    <div class="modal-body">
                                        <div class="col">
                                          <label for="">Have additional comment on this report (optional)</label>
                                          <textarea name="report" id="" class="form-control" maxlength="250">
                                          </textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      <button type="submit"  class="btn btn-success">Report post</button>
                                    </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                        <!-- End report post -->
                        <!-- visibility spell -->
                        <!--Edit Post-->
                            <div class="modal fade" id="editModal<?php echo $post->post_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil"></i> Edit post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form class="" action="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->post_id;?>" onsubmit="return TpValidateupdate()" enctype="multipart/form-data" method="post">
                                    <div class="modal-body">
                                      <div class="col mt-4">
                                        <textarea name="post_text" dir="auto" id="" style="resize: none;" class="form-control form-control-lg" maxlength="500" placeholder="Say something here..">
                                          <?php echo $post->post;?>
                                        </textarea>
                                        <?php if (!empty($post->post_image && $post->post_image != "assets/posts/")): ?>
                                            <img src="<?php echo URLROOT;?>/<?php echo $post->post_image; ?>" height="100" width="100" style="position: relative; top: .5em; left: 1em; width: auto; height: auto; max-height: 140px; max-width: 140px; border-radius: 5px;">
                                        <?php endif; ?>
                                      </div>
                                        <div class="file-field" style="position: absolute; top: 5.7em; left: 45em;">
                                          <div class="d-flex justify-content-left">
                                            <div class="">
                                              <span class="blue-text"><i class="fa fa-picture-o fa-lg"></i></span>
                                              <input type="file" id="fileUpdate" name="image" accept=".jpg, .png, .gif, .jpeg">
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-primary">Update post</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        <!-- End edit post -->
                        <!-- visibility spell -->
                        <!--Delete Post-->
                            <div class="modal fade" id="deleteModal<?php echo $post->post_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash" aria-hidden='true'></i> Delete post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <form class="" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $post->post_id;?>" method="get">
                                    <div class="modal-body">
                                      Are you Sure you want Delete this post?
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No cancel</button>
                                      <button type="submit" class="btn btn-danger">Yes delete</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        <!-- End Delete -->
                        <!-- Basic dropdown -->
                        <span class="pull-right">
                          <a href="javascript:void(0)" title="Save this post" class="mr-4" onclick="return savedMy('<?php echo $post->post_id;?>');">
                            <i class="fa fa-bookmark fa-lg" aria-hidden="true"></i>
                          </a>
                          <a href="javascript:void(0)" title="Message the post owner">
                            <i class="fa fa-envelope fa-lg" aria-hidden="true"></i>
                          </a>
                        </span>

                      </div>
                      <p class="card-text">
                          <?php echo getPostLink(nl2br($post->post)); ?>
                      </p>
                      <div class="feed-body">
                       <?php if (!empty($post->post_image && $post->post_image != "assets/posts/")): ?>
                         <div class="post-image-style">
                           <img src="<?php echo URLROOT;?>/<?php echo $post->post_image; ?>" width="540" height="400" alt="post image">
                         </div>
                       <?php endif; ?>
                     </div>
                     <div class="comment_like">
                       <ul class="comment_style">
                         <li class="likes_only">
                             <?php if (UserLikedOrNot($_SESSION['user_id'],$post->post_id)): ?>
                               <span class="unlike fa fa-heart" onclick="return removeLikes('<?php echo $post->post_id; ?>')"></span>
                               <span class="like hide fa fa-heart-o" onclick="return addLikes('<?php echo $post->post_id; ?>')"></span>
                             <?php else: ?>
                               <span class="like fa fa-heart-o" onclick="return addLikes('<?php echo $post->post_id; ?>')"></span>
						                   <span class="unlike hide fa fa-heart" onclick="return removeLikes('<?php echo $post->post_id; ?>')"></span>
                             <?php endif; ?>

                           <span class="likes_count"><?php echo likesOrLike($post->like_count); ?></span>
                         </li>
                         <li class="comments_only">
                           <span  class="comment-btn"><i class="fas fa-comment-alt"></i> Comments <span>0</span></span>
                         </li>
                       </ul>
                        <div class="">
                          <div class="comment_post">
                            <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $post->username; ?>" class="user_comment_pic">
                              <?php if (!empty($post->profile_pic)): ?>
                                <img src="<?php echo URLROOT;?>/<?php echo $post->profile_pic; ?>" width="40" height="40" alt="profile pic">
                              <?php else: ?>
                                <img src="<?php echo URLROOT;?>/public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                              <?php endif; ?>
                            </a>
                            <textarea dir="auto" style="resize: none;" class="comment_field" id="comment_text_<?php echo $post->post_id; ?>" autocomplete="off" placeholder="leave a comment.."></textarea>
                            <a href="javascript:void(0)" class="send_post" onclick="return commentodb('<?php echo $post->post_id; ?>');">
                              <img src="<?php echo URLROOT;?>/public/assets/send-button.png" width="30" height="30" alt="Comment">
                            </a>
                          </div>
                          <?php foreach ($data['comments'] as $postCom): ?>
                           <div class="disply_comments">
                            <?php if ($post->post_id == $postCom->post_id): ?>
                              <div class="comment_view_holder">
                                <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $postCom->username; ?>" class="commented_user">
                                  <?php if (!empty($post->profile_pic)): ?>
                                    <img src="<?php echo URLROOT;?>/<?php echo $postCom->profile_pic; ?>" width="40" height="40" alt="profile pic">
                                  <?php else: ?>
                                    <img src="<?php echo URLROOT;?>/public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                                  <?php endif; ?>
                                </a>
                                  <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $postCom->username; ?>" class="commented_username"><?php echo $postCom->firstname; ?></a>
                                <div class="comment_holder">
                                  <p>
                                    <?php echo $postCom->comment; ?>
                                  </p>
                                </div>
                              </div>
                            <?php endif; ?>
                           </div>
                          <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
              </div>
            </div>
          </div>
        </section>
        <?php endforeach; ?>

    </div>
    <script type="text/javascript">

            function savedMy(id) {

              $.ajax({

                  url: "<?php echo URLROOT; ?>/posts/savePost/"+id,
                  type: 'post',
                  success: function (response)
                  {
                      if (response == true)
                      {
                          alert("Post was saved successfuly");
                      } else
                      {
                          alert("Failed to save post (post was already saved)!");
                          return false;
                      }
                  }
              });
            }


        function triggerClick(e) {
              document.querySelector('#file').click();
          }

          function previewImage(e) {
            if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
              document.querySelector('#filepreview').setAttribute('height', 100);
              document.querySelector('#filepreview').setAttribute('width', 100);
              document.querySelector('#filepreview').setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
          }
        }

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
            if (image != "") {
              if(!allowedExtensions.exec(image)){
                  alert('Please upload file having extensions .jpeg .jpg .png .gif only.');
                  fileInput.value = '';
                  return false;
              }
            }

            var fileSize = document.getElementById('file').files[0].size;
            if(fileSize > 2097152){
               alert("Maximum file size exceeded, file size must be less than or equals 2mb");
               fileInput.value = '';
               return false;
            };

            return true;

        }

        function TpValidateupdate(){
          // var post = document.getElementById('area');
          // var postData = post.value;
          var fileInput = document.getElementById('fileUpdate');
          var image = fileInput.value;

          var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
          if (image != "") {
            if(!allowedExtensions.exec(image)){
                alert('Please upload file having extensions .jpeg .jpg .png .gif only.');
                fileInput.value = '';
                return false;
            }
          }

          var fileSize = document.getElementById('fileUpdate').files[0].size;
          if(fileSize > 2097152){
             alert("Maximum file size exceeded, file size must be less than or equals 2mb");
             fileInput.value = '';
             return false;
          };

          return true;

      }

      function commentodb(pid){
        var comment_text = $.trim($('#comment_text_'+pid).val());
        if(comment_text == ''){

          }else{
            $.ajax({
                type:'POST',
                url:'<?php echo URLROOT; ?>/posts/AddComment/',
                data:{"pid":pid, "comment_text":comment_text},
                cache: false,
                success: function(comment){
                  if (comment == true) {
                    alert('Comment added');
                    $('#comment_text_'+pid).val('');
                    setTimeout(function(){
                      location.reload();
                    });
                  }else {
                    alert('Sorry something went wrong, Please try again');
                    return false;
                  }
                }
            });
          }
      }

        function addLikes(postid){
          $post = $(this);
          $.ajax({
            url: '<?php echo URLROOT; ?>/posts/AddLike/',
            type: 'post',
            data: {
              'liked' : 1,
              'postid': postid
            },
            success: function(response){
              alert('Added like');
              $post.addClass('hide');
              $post.siblings().removeClass('hide');
              setTimeout(function(){
                location.reload();
              });
            }
          });
        }

        function removeLikes(postid){
          $post = $(this);
          $.ajax({
            url: '<?php echo URLROOT; ?>/posts/removeLike/',
            type: 'post',
            data: {
              'unliked' : 1,
              'postid': postid
            },
            success: function(response){
              alert('Removed like');
              $post.addClass('hide');
              $post.siblings().removeClass('hide');
              setTimeout(function(){
                location.reload();
              });
            }
          });
        }

    </script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
