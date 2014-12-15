<?php

ini_set( "log_errors", true );
ini_set( "error_reporting", E_ALL );
ini_set( "error_log", "/path/to/task-tango/folder/error_log" );

date_default_timezone_set( "Australia/Sydney" );  // http://www.php.net/manual/en/timezones.php
define( "APP_URL", "index.php" );
define( "DB_DSN", "mysql:host=us-cdbr-iron-east-01.cleardb.net;dbname=heroku_15ede35289a90dc" );
define( "DB_USERNAME", "b6fd02cc9521fb" );
define( "DB_PASSWORD", "a9fc827d" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "PASSWORD_EMAIL_FROM_NAME", "Stay Fit" );
define( "PASSWORD_EMAIL_FROM_ADDRESS", "gthiagaraja@gmail.com" );
define( "PASSWORD_EMAIL_SUBJECT", "Your New Stay Fit Password" );
define( "PASSWORD_EMAIL_APP_URL", "http://stayfit.herokuapp.com/" );
define("HOST","smtp.gmail.com");
define("PORT","587");
define("USERNAME","stayfit.nyu@gmail.com");
define("PASSWORD","hcifall2014");
require( CLASS_PATH . "/Mail.php" );
require( CLASS_PATH . "/User.php" );
require( CLASS_PATH . "/Todo.php" );
?>
