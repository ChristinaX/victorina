<?php
function formatstr($str) 
    {
        $str = trim($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str);
        return $str;
    }
if (isset($_GET['score'])) $score = intval($_GET['score']);

$user = $_GET['user'];
session_start();
if (isset($_SESSION['login'])) {
if(  !isset(  $_SESSION['count1']  )  )  $_SESSION['count1']  =  0;
    $_SESSION['count1']++;
if ($_SESSION['count1'] >1) {
session_unset();
session_destroy();
?>
<script>
alert('До свидания!'); location.replace('victorina.php');

</script>
<?php }
formatstr($user);
formatstr($score);
if ($score == 0) {$str = 'ВЫ НИЧЕГО НЕ ЗАРАБОТАЛИ!!!'; $style = '0win.css';$img = 'devil2.jpg';}
elseif ($score >= 80) {$str = 'ВЫ ВЫИГРАЛИ!!!'; $style = '80win.css';$img = 'devil.gif';}
else  { if($score >4) $text_score = 'очков';
	else $text_score = 'очка';
	$str = 'у Вас ' . $score . ' ' . $text_score; $style = 'xwin.css';$img = '0_9b186_756e0180_XL.png';}

session_unset();
session_destroy();
}
?>
<!DOCTYPE html>
    <head>
    <meta charset="utf-8">
    <title>Викторина</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $style ?>" />
    <script type="text/javascript" src="jquery-3.1.1.js"></script>
    <script type="text/javascript" src="jquery-color.js"></script>
    <script type="text/javascript" src="myscripts4.js"></script>
</head>
<body>
<p id='over'>Игра завершена</p>
<div id='how'>
<p><?php echo $user . ', ' . $str; ?></p>
</div>
<img src="<?php echo $img; ?>" width='200px' height = '200px' alt='' id ='dem'>
<div id='main'><p><a href='victorina.php'>На главную</a></p></div>
<div id='otchet'><p><a href='#'>Статистика игры</a></p></div>
<div id = 'mur1'></div>
<div id = 'mur2'></div>
<div id = 'mur3'></div>
<div id = 'mur4'></div>
</body>
</html>