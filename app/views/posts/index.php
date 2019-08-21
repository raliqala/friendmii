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
    </div> -->

  <!--  <div class="row pull-right mr-auto">
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
                  <input type="text" class="form-control-custom" name="" data-toggle="modal" data-target="#postModal" placeholder="Have something in mind...">
                </div>
                <div class="post-camera">
                  <a href="" data-toggle="modal" data-target="#postModal"><i class="fa fa-picture-o"></i></a>
                </div>
              </div>

              <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square-o"></i> Create a new post</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <div class="post-post">
                          <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $_SESSION['username']; ?>">
                            <?php if (!empty($_SESSION['profile_pic'])): ?>
                              <img src="<?php echo URLROOT;?>/<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                            <?php else: ?>
                              <img src="./public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                            <?php endif; ?>
                          </a>
                        </div>
                        <form form="postForm" id="postForm" action="<?php echo URLROOT; ?>/posts/post/" onsubmit="return TpValidate()" enctype="multipart/form-data" method="post">
                          <textarea name="post_text" class="textareaClass" id="area" placeholder="Write something here..." data-emojiable="true"></textarea>
                          <span aria-hidden="true" title="Remove image.." id="removeimageid" onclick="removeimage()" style="position: absolute; cursor: pointer; display: none;; left: 4em; bottom: 9px; z-index: 1;color: orange;" class="fa fa-times-circle"></span>
                          <img src="" height="" width="" title="Choose different image.." onClick="triggerClick()" id="filepreview" style="display: none; position: relative; top: .5em; left: 3em; width: auto; height: auto; max-height: 140px; max-width: 140px; border-radius: 5px; cursor: pointer;">
                          <div class="file-field" style="position: absolute; bottom: .1em; left: 34.5em;">
                           <div class="d-flex">
                             <div class="after-d-flex">
                               <span class="blue-text"><i style="font-size: 2em;" class="fa fa-picture-o"></i></span>
                               <input type="file" onChange="previewImage(this)" id="file" name="image" accept=".jpg, .png, .gif, .jpeg">
                             </div>
                           </div>
                         </div>
                         <select name="privacy" class="browser-default custom-select" style="position: absolute;margin-top: 1.9em !important; width:30%;">
                          <option selected value="public">Public</option>
                          <option value="friendsonly">Friend only</option>
                          <option value="private">Private</option>
                        </select>
                      </div>
                      <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button> -->
                        <button type="submit" style="width: 30%;" class="btn btn-primary">Post</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </section>

        <div id="comments-ts" style="z-index:100000;" class="mt-3">
        </div>

        <?php
        // $test = getfriends($_SESSION['user_id']);
        // foreach ($test as $row) {
        //   foreach ($row as $value) {
        //     echo '<div class="user_box">
        //              <span>'.$value->username.'</span>
        //          </div>';
        //   }
        // } ?>


        <?php foreach($data['posts'] as $post) :?>
         <?php if (isMyFriend($post->username)): ?>
          <section class="display_posts_only" id="<?php echo $post->post_id; ?>">
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

                        <a href="javascript:void(0)" class="a-move pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                        <div class="dropdown-menu">
                          <?php if ($_SESSION['user_id'] != $post->user_id): ?>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#reportPostModal<?php echo $post->post_id;?>">
                              <i class="fa fa-bug"></i> Report post
                            </a>
                          <?php else: ?>
                            <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#editModal<?php echo $post->post_id;?>">
                              <i class="fa fa-pencil"></i> Edit post
                            </a>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="return deletePost('<?php echo $post->post_id;?>')">
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
                            <div class="modal fade" id="editModal<?php echo $post->post_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-pencil-square-o"></i> Update post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="post-post">
                                        <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $_SESSION['username']; ?>">
                                          <?php if (!empty($_SESSION['profile_pic'])): ?>
                                            <img src="<?php echo URLROOT;?>/<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                                          <?php else: ?>
                                            <img src="./public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                                          <?php endif; ?>
                                        </a>
                                      </div>

                                      <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $post->post_id;?>" onsubmit="return TpValidateupdate('<?php echo $post->post_id;?>','<?php echo $post->post_image; ?>')" enctype="multipart/form-data" method="post">
                                        <textarea name="post_text" class="textareaClass" id="area" placeholder="Write something here..." data-emojiable="true"><?php echo $post->post;?></textarea>
                                        <?php if (!empty($post->post_image && $post->post_image != "assets/posts/")): ?>
                                            <img src="<?php echo URLROOT;?>/<?php echo $post->post_image; ?>" height="1000" width="1000" style="position: relative; top: .5em; left: 2.7em; width: auto; height: auto; max-height: 140px; max-width: 140px; border-radius: 5px;">
                                        <?php endif; ?>
                                        <div class="file-field" style="position: absolute; bottom: .1em; left: 34.5em;">
                                         <div class="d-flex">
                                           <div class="after-d-flex">
                                             <span class="blue-text"><i style="font-size: 2em;" class="fa fa-picture-o"></i></span>
                                             <input type="file" id="fileUpdate" name="image" accept=".jpg, .png, .gif, .jpeg">
                                           </div>
                                         </div>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                      <button type="submit" class="btn btn-primary">Update post</button>
                                    </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        <!-- End edit post -->
                        <!-- visibility spell -->
                        <!--Delete Post-->
                            <!-- <div class="modal fade" id="deleteModal<?php echo $post->post_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            </div> -->
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

                           <span class="likes_count" style="color: #575757;"><?php echo likesOrLike(format_num($post->like_count)); ?></span>
                         </li>
                         <li class="comments_only">
                           <span  class="comment-btn" onclick="showComments('<?php echo $post->post_id; ?>')"><i class="fas fa-comment-alt"></i> <span style="color: #575757;">Comments <?php echo format_num($post->comment_count); ?></span></span>
                         </li>
                       </ul>

                        <div id="show_hide_comments_<?php echo $post->post_id; ?>" style="display:none;">
                          <div class="comment_post">
                            <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $_SESSION['username']; ?>" class="user_comment_pic">
                              <?php if (!empty($_SESSION['profile_pic'])): ?>
                                <img src="<?php echo URLROOT;?>/<?php echo $_SESSION['profile_pic']; ?>" width="40" height="40" alt="profile pic">
                              <?php else: ?>
                                <img src="<?php echo URLROOT;?>/public/assets/blank-profile.png" width="40" height="40" alt="profile pic">
                              <?php endif; ?>
                            </a>
                            <textarea style="resize: none; overflow: hidden;" class="comment_field" id="comment_text_<?php echo $post->post_id; ?>" autocomplete="off" placeholder="leave a comment..."></textarea>
                            <a href="javascript:void(0)" class="send_post" onclick="return commentodb('<?php echo $post->post_id; ?>');">
                              <img src="<?php echo URLROOT;?>/public/assets/send-button.png" width="30" height="30" alt="Comment">
                            </a>
                          </div>

                          <?php foreach ($data['comments'] as $postCom): ?>
                           <div class="disply_comments">
                            <?php if ($post->post_id == $postCom->post_id): ?>
                              <div class="comment_view_holder">
                                <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $postCom->username; ?>" class="commented_user_pic">
                                  <?php if (!empty($postCom->profile_pic)): ?>
                                    <img src="<?php echo URLROOT;?>/<?php echo $postCom->profile_pic; ?>" width="35" height="35" alt="profile pic">
                                  <?php else: ?>
                                    <img src="<?php echo URLROOT;?>/public/assets/blank-profile.png" width="35" height="35" alt="profile pic">
                                  <?php endif; ?>
                                </a>
                                <a href="<?php echo URLROOT; ?>/profile?u=<?php echo $postCom->username; ?>" class="commented_username"><?php echo $postCom->firstname; ?></a>
                                <div class="comment_holder">
                                  <a href="javascript:void(0)" class="a-move-comment pull-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                  <div class="dropdown-menu">
                                    <?php if ($_SESSION['user_id'] != $postCom->user_id): ?>
                                      <a class="dropdown-item" href="javascript:void(0)" data-target="<?php echo $postCom->comment_id;?>">
                                        <i class="fa fa-bug"></i> Report comment
                                      </a>
                                    <?php else: ?>
                                      <a class="dropdown-item" href="javascript:void(0)" onclick="editComment('<?php echo $postCom->comment_id;?>')">
                                        <i class="fa fa-pencil"></i> Edit comment
                                      </a>
                                      <a class="dropdown-item" href="javascript:void(0)" onclick="return deleteComment('<?php echo $postCom->comment_id;?>','<?php echo $post->post_id; ?>')">
                                        <i class="fa fa-trash" aria-hidden='true'></i> Delete comment
                                      </a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item" href="javascript:void(0)" data-cid="<?php echo $postCom->comment_id;?>">
                                        <i class="fa fa-bug"></i> Report comment
                                      </a>
                                    <?php endif; ?>
                                  </div>
                                  <p id="commentContent_<?php echo $postCom->comment_id; ?>">
                                    <?php echo getPostLink(nl2br($postCom->comment)); ?>
                                  </p>
                                    <?php if ($_SESSION['user_id'] == $postCom->user_id): ?>
                                      <div id="editComment_<?php echo $postCom->comment_id; ?>" style="display:none; margin-left: 3.3em; margin-top: -.6em;">
                                          <textarea id="commEditBox_<?php echo $postCom->comment_id; ?>" class="form-control" rows="2" style="width: 435px; resize: none; border-radius: 4px;"><?php echo $postCom->comment; ?></textarea>
                                          <button type="submit" style="width: 20%; border: none;border-radius: 3px;background-color: #007bff;color: white;cursor: pointer;" onclick="UpdateComment('<?php echo $postCom->comment_id; ?>')">Save</button>
                                          <button type="button" style="width: 20%; border: none; border-radius: 3px; background-color: #b0b1b3; color: white; cursor: pointer; margin-top: 5px;" onclick="editComment_cancel('<?php echo $postCom->comment_id; ?>')">Cancel</button>
                                      </div>
                                    <?php endif; ?>
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
        <?php endif; ?>
        <?php endforeach; ?>

    </div>
    <script type="text/javascript">

            function editComment(cid){
              $('#commentContent_'+cid).hide();
              $('#editComment_'+cid).show();
            }

            function editComment_cancel(pid){
              $('#commentContent_'+pid).show();
              $('#editComment_'+pid).hide();
            }

            function UpdateComment(cid){
              var comment_text = $.trim($('#commEditBox_'+cid).val());
              //alert(comment_text);
              if(comment_text == ''){

                }else{
                  $.ajax({
                      type:'POST',
                      url:'<?php echo URLROOT; ?>/posts/UpdateComment/',
                      data:{"cid":cid, "comment_text":comment_text},
                      cache: false,
                      success: function(comment){
                        if (comment == true) {
                          setTimeout(function(){
                            location.reload();
                            // var x = document.getElementById("show_hide_comments_"+pid);
                            // x.style.display = 'block';
                          });
                        }else {
                          alert('Sorry something went wrong, Please try again');
                          return false;
                        }
                      }
                  });
                }
            }

            function savedMy(id){
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

            function removeimage() {
              document.querySelector('#filepreview').setAttribute('src', '');
              var fileInput = document.getElementById('file');
              fileInput.value = '';
              document.querySelector('.emoji-wysiwyg-editor').setAttribute('placeholder','Write something here...');
              document.querySelector('#filepreview').style.display = 'none';
              document.querySelector('#removeimageid').style.display = 'none';
            }


            function triggerClick(e) {
                  document.querySelector('#file').click();
              }

          function previewImage(e) {
            if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e){
              document.querySelector('#filepreview').style.display = 'block';
              document.querySelector('#filepreview').setAttribute('height', 100);
              document.querySelector('#filepreview').setAttribute('width', 100);
              document.querySelector('#filepreview').setAttribute('src', e.target.result);
              document.querySelector('#removeimageid').style.display = 'block';
              document.querySelector('.emoji-wysiwyg-editor').setAttribute('placeholder','Write something about this image...');
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
                  removeimage();
                  return false;
              }
            }

            var fileSize = document.getElementById('file').files[0].size;
            if(fileSize > 2097152){
               alert("Maximum file size exceeded, file size must be less than or equals 2mb");
               fileInput.value = '';
               removeimage();
               return false;
            };

            return true;

        }

        function TpValidateupdate(id, dbimage){
          var $modal = $("#editModal"+id);
          var postData = $modal.find('#area').val();
          var image = $modal.find('#fileUpdate').val();
          var fileSize = $modal.find('#fileUpdate')[0].files[0].size;
          var db_image = dbimage;

          if (postData == "" && postData == null && image == "" && image == null && db_image == "assets/posts/")
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
                removeimage();
                return false;
            }
          }

          if(fileSize > 2097152){
             alert("Maximum file size exceeded, file size must be less than or equals 2mb");
             fileInput.value = '';
             removeimage();
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
                    //alert('Comment added');
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
              //alert('Added like');
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
              //alert('Removed like');
              $post.addClass('hide');
              $post.siblings().removeClass('hide');
              setTimeout(function(){
                location.reload();
              });
            }
          });
        }

        function deletePost(post_id){
    	       if (confirm('Are you sure you want to delete this post?')) {
                  $.ajax({
                   url: '<?php echo URLROOT; ?>/posts/delete/'+post_id,
                   type: "POST",
                     success: function (response) {
                       alert('Post was deleted');
                       setTimeout(function(){
                         location.reload();
                   });
                },
                error: function(){
            			alert("Sorry something went wrong please try again..");
            		}
             });
    	    }
    		}

        function deleteComment(comment_id, post_id){
    	       if (confirm('Are you sure you want to delete this comment?')) {
                  $.ajax({
                   url: '<?php echo URLROOT; ?>/posts/deleteComment/'+comment_id,
                   type: "POST",
                   data: {
                     'postid': post_id,
                   },
                     success: function (response) {
                       alert('Comment was deleted');
                       setTimeout(function(){
                         location.reload();
                   });
                },
                error: function(){
            			alert("Sorry something went wrong please try again..");
            		}
             });
    	    }
    		}

        function showComments(elemid){
          var x = document.getElementById("show_hide_comments_"+elemid);
            if (x.style.display === "none") {
              x.style.display = "block";
            } else {
              x.style.display = "none";
            }
        }


        var textarea = document.querySelector('textarea');
        textarea.addEventListener('keydown', autosize);
        function autosize(){
          var el = this;
          setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            // for box-sizing other than "content-box" use:
            // el.style.cssText = '-moz-box-sizing:content-box';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
          },0);
        }

        // $(document).ready(function(){
        //   windowOnScroll();
        // });
        //
        // function windowOnScroll() {
        //        $(window).on("scroll", function(e){
        //         if ($(window).scrollTop() == $(document).height() - $(window).height()){
        //             if($(".display_posts_only").length < $("#total_count").val()) {
        //                 var lastId = $(".display_posts_only:last").attr("id");
        //                 getMoreData(lastId);
        //             }
        //         }
        //     });
        // }

        // function getMoreData(lastId) {
        //        $(window).off("scroll");
        //     $.ajax({
        //         url: 'postsForReload(lastId)',
        //         type: "get",
        //         beforeSend: function ()
        //         {
        //             $('.ajax-loader').show();
        //         },
        //         success: function (data) {
        //         	   setTimeout(function() {
        //                 $('.ajax-loader').hide();
        //           for (var i = 0; i < data.length; i++) {
        //             console.log(data[i]);
        //           }
        //             windowOnScroll();
        //         	   }, 1000);
        //         }
        //    });
        // }



    </script>
<div class="" style="margin-top:3em;"></div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
