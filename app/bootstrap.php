<?php
  // require_once 'libraries/Core.php';
  // require_once 'libraries/Controller.php';

  // Load Config
  require_once 'config/config.php';
  // Load Helpers
  require_once 'helpers/session_helper.php';
  require_once 'helpers/url_helper.php';
  require_once 'helpers/token_helper.php';
  require_once 'helpers/email_helper.php';
  require_once 'helpers/time_helper.php';
  //require_once 'PHPMailer/PHPMailerAutoload.php';

  // Autoload Core Classes
  spl_autoload_register(function ($className) {
      require_once 'libraries/'. $className . '.php';
  });
