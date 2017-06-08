<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Викторина</title>
    <link rel="stylesheet" type="text/css" href="sweet-alert.css">
    <link rel="stylesheet" type="text/css" href="style1.css" />
    <script src="sweet-alert.js"></script>
    <script type="text/javascript" src="jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="jquery-color.js"></script>
    <script type="text/javascript" src="myscripts3.js"></script>
</head>
<body>
<div id='showbegin'>
Начало игры
</div>
<div id = 'ramka'><div id = 'progress'></div></div>
<div id ='showend'>
Конец игры
</div>
<div id = 'nachalo'></div>
<div id ='stat'>
<div id ='stat1'>
<table id = 'summary'>
<tr class='zagolovok'><td style='padding-bottom:10px' colspan=2>Статистика<td><tr>
<tr><th>Игрок</th><th>Очки</th></tr>
<?php
if (isset($_GET['gamer']))
$gamer = $_GET['gamer'];
session_start();
$_SESSION['login'] = $gamer;
if(  !isset(  $_SESSION['count']  )  )  $_SESSION['count']  =  0;
    $_SESSION['count']++;
if ($_SESSION['count'] >1) {
session_unset();
session_destroy();
?>
<script>
swal('Игра будет завершена!'); {location.replace('victorina.php');}
</script>
<?php }
require("config.php");
$db = new Connect();
$param = $db->ConnectToBase();
$sql = "select * from users where score not in ('0') order by score desc";
$cat=Users::getList($param,$sql);
foreach ($cat['results'] as $category) { ?>
<tr>
    <td><?php echo $category->user; ?></td><td><?php echo $category->score; ?></td>
</tr>
<?php }
?>
</table>
</div>
</div>
<div id ="header">
<p id = "nowplay">Игрок: <?php echo $gamer; ?></p>
<div id="rezultat"></div>

</div>
<div id='proverka'></div>
</div>
<button id='end'>Завершить игру</button>
<div id = 'answer'>
<p></p>
<input type = 'text' id='youranswer' autofocus>
<button type='submit' id='button2'>Ответить</button>
<div id='ramka_time1'><div id='time1'></div></div>
</div>
<div id='0'></div>
<div id='6'></div>
<div id='12'></div>
<div id='18'></div>
<div id='24'></div>
<div id='30'></div>
<div id='42'></div>
<table id="block1">
<tr><td id="geography" class="punkt1 punkt2">География</td><td id="10" class="punkt1 geo10">10</td><td id="10" class="punkt1 geo10">8</td><td id = "10" class="punkt1 geo10">6</td><td id = "10" class="punkt1 geo10">4</td><td id = "10" class="punkt1 geo10">2</td></tr>

<tr><td id="izo" class="punkt1 punkt2">Искусство</td><td id="8" class="punkt1 geo10">10</td><td id="8" class="punkt1 geo10">8</td><td id = "8" class="punkt1 geo10">6</td><td id = "8" class="punkt1 geo10">4</td><td id = "8" class="punkt1 geo10">2</td></tr>

<tr><td id="history" class="punkt1 punkt2">История</td><td id="6" class="punkt1 geo10">10</td><td id="6" class="punkt1 geo10">8</td><td id = "6" class ="punkt1 geo10">6</td><td id = "6" class="punkt1 geo10">4</td><td id = "6" class="punkt1 geo10">2</td></tr>

<tr><td id="cinema" class="punkt1 punkt2">Кино</td><td id="5" class="punkt1 geo10">10</td><td id="5" class="punkt1 geo10">8</td><td id = "5" class="punkt1 geo10">6</td><td id = "5" class="punkt1 geo10">4</td><td id = "5" class="punkt1 geo10">2</td></tr>

<tr><td id="lit" class="punkt1 punkt2">Литература</td><td id="4" class="punkt1 geo10">10</td><td id="4" class="punkt1 geo10">8</td><td id = "4" class="punkt1 geo10">6</td><td id = "4" class="punkt1 geo10">4</td><td id = "4" class="punkt1 geo10">2</td></tr>

<tr><td id="music" class="punkt1 punkt2">Музыка</td><td id="3" class="punkt1 geo10">10</td><td id="3" class="punkt1 geo10">8</td><td id = "3" class="punkt1 geo10">6</td><td id = "3" class="punkt1 geo10">4</td><td id = "3" class="punkt1 geo10">2</td></tr>

<tr><td id="sc" class="punkt1 punkt2">Наука</td><td id="2" class="punkt1 geo10">10</td><td id="2" class="punkt1 geo10">8</td><td id = "2" class="punkt1 geo10">6</td><td id = "2" class="punkt1 geo10">4</td><td id = "2" class="punkt1 geo10">2</td></tr>

<tr><td id="sport" class="punkt1 punkt2">Спорт</td><td id="1" class="punkt1 geo10">10</td><td id="1" class="punkt1 geo10">8</td><td id = "1" class="punkt1 geo10">6</td><td id = "1" class="punkt1 geo10">4</td><td id = "1" class="punkt1 geo10">2</td></tr>
</table>
</div>
</body>
</html>