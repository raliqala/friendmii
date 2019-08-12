</div>

<script src="<?php echo URLROOT; ?>/js/jquery-disable-with.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="<?php echo URLROOT; ?>/js/main.js" charset="utf-8"></script>
<!-- <script type="text/javascript" src="<?php echo URLROOT; ?>/js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/jquery-3.3.1.min.js"></script>
<!-- <script type="text/javascript" src="<?php echo URLROOT; ?>/js/popper.min.js"></script> -->
<script type="text/javascript" src="<?php echo URLROOT; ?>/js/mdb.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/config.js"></script>
<script src="<?php echo URLROOT; ?>/js/util.js"></script>
<script src="<?php echo URLROOT; ?>/js/jquery.emojiarea.js"></script>
<script src="<?php echo URLROOT; ?>/js/emoji-picker.js"></script>
<script type="text/javascript">
    // $(".button-collapse").sideNav();
    // new WOW().init();
    $(function() {
      // Initializes and creates emoji set from sprite sheet
      window.emojiPicker = new EmojiPicker({
        emojiable_selector: '[data-emojiable=true]',
        assetsPath: 'http://localhost/testproject/public/css/img/',
        popupButtonClasses: 'fa fa-smile-o'
      });
      // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
      // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
      // It can be called as many times as necessary; previously converted input fields will not be converted again
      window.emojiPicker.discover();
    });
    var emojis = (function() {
      // Set the size of the rendered Emojis
      // This can be set to 16x16, 36x36, or 72x72
      twemoji.size = '72x72';

      // Parse the document body and
      // insert <img> tags in place of Unicode Emojis
      twemoji.parse(document.body);
    }(window, twemoji));

    // Wait for document to finish loading
    function ready(cb) {
      if (document.readyState != 'loading') {
        cb();
      } else {
        document.addEventListener('DOMContentLoaded', cb);
      }
    }

    ready(emojis);
</script>
</body>
</html>
