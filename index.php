<?php
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL & ~E_NOTICE);
//    error_reporting(E_ALL);

  require_once 'config.php';
  require_once C_DIR . 'Controller.php';
  require_once C_DIR . 'RouterController.php';
  require_once M_DIR . 'db.php';

  new RouterController();