<?php
require("config.php");
$db = new Connect();
$param = $db->ConnectToBase();
$sql = "select * from users";
$cat=Users::getScore($param,$user,$sql);
$score = $cat->score;
$name = $cat->user;
$data = $name . '' . $score;
echo $data;
?>