<?php
require("config.php");
$cat = new Users;
$db = new Connect();
$param = $db->ConnectToBase();
if (isset($_POST['user']))
$user = $_POST['user'];
$cat->insert($param,$user);
$c = $cat -> added;
echo $c;
?>