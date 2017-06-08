<?php
require("config.php");
$answer = $_POST['answer'];
$table = $_POST['table'];
$db = new Connect();
$param = $db->ConnectToBase();
$results = array();
$db = new Connect();
$sql = "select score from " . $table . " where answer like '%" . $answer . "%'";
$param = $db->ConnectToBase();
$data = Victorina::getList($param,$sql);
if (isset($data)) 
    $dat = $data -> score;
    
    
else $dat = 0;
echo $dat;
?>
