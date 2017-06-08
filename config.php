<?php
ini_set( "display_errors", true );
define( "DB_DSN", "mysql:host=localhost;dbname=victorina" );
define( "DB_USERNAME", "debian-sys-maint" );
define( "DB_PASSWORD", "XaALLiGn7ty7Lx1o" );
define( "CLASS_PATH", "classes" );
define( "ADMIN_USERNAME", "admin" );
define( "ADMIN_PASSWORD", "mypass" );
require( CLASS_PATH . "/Category.php" );
require( CLASS_PATH . "/Books.php" );
require( CLASS_PATH . "/Connect.php" );
require( CLASS_PATH . "/Victorina.php" );
require( CLASS_PATH . "/Users.php" );
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
    }
set_exception_handler( 'handleException' );
?>
