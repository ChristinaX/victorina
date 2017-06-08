<?php
require("config.php");
if (isset($_POST['score']))
$score = $_POST['score'];
if (isset($_POST['user']))
$user = $_POST['user'];
$cat = new Users;
$db = new Connect();
$param = $db->ConnectToBase();
$cat->addScore($param,$score,$user);
?>
