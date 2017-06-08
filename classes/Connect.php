<?php

class Connect {
    public $options = null;
    public $conn = null;
    public  function ConnectToBase() {
     $options = array( PDO:: MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
     $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, $options );
     return $conn;
}


}