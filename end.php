<?php
require("config.php");
$user = $_POST['user'];
$db = new Connect();
$param = $db->ConnectToBase();
#"select score from users where user=" . $user;
$sql = "select score from users where user='$user'";
$cat=Users::getScore($param,$sql);

#$data = $cat->score;
echo $cat;
?>