<?php
require("config.php");
$user1 = $_POST['name'];
#$user = trim(mb_strtolower($user1));
$db = new Connect();
$param = $db->ConnectToBase();
$results = array();
$sql = "select user from users  where user ='$user1'  limit 1";
$param = $db->ConnectToBase();
$data = Victorina::getList($param,$sql);
if (isset($data)) $dat = 1;
else $dat = 0;
 echo $dat;


?>