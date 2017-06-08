<?php
require("config.php");
$table = $_POST['table'];
$score = $_POST['score'];
$db = new Connect();
$param = $db->ConnectToBase();
$results = array();
#$db = new Connect();
$sql = "select question from " . $table . " where score =" . $score;
$param = $db->ConnectToBase();
$data = Victorina::getList($param,$sql);
$dat = $data -> question;
?>
<?php echo $dat; ?>