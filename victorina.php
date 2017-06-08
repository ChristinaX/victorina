<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Викторина</title>
    <link rel="stylesheet" type="text/css" href="style1.css" />
    <script type="text/javascript" src="jquery-3.1.1.js"></script>
    <script type="text/javascript" src="myscripts2.js"></script>
    <script type="text/javascript" src="jquery-color.js"></script>
    <script type="text/javascript">
	document.getElementById('proverka').innerHTML = "";
	function animateText(id, text, i) {
	document.getElementById('description').style.display = 'block';
	document.getElementById(id).innerHTML = text.substring(0, i);
	document.getElementById('begin1').style.display = 'none';
	i++;
	if (i <= text.length) {
	    setTimeout("animateText('" + id + "','" + text + "'," + i + ")", 10);
	    if (i==text.length) {
		document.getElementById('entername').style.display = 'block';
	    }
	}
	}
    </script>
    <style>
	.myClass {bacground-color: yellow;}
    </style>
</head>
<body>
<div id ="header">
<h1 id="privet">ДОБРО ПОЖАЛОВАТЬ НА ВИКТОРИНУ!!!</h1>
</div>

<button id="begin1" onclick = 'animateText("swim_text", "В игре вопросы разделены на 8 категорий. Максимальная цена вопроса 10 очков, минимальная 2 очка. Вам нужно набрать 80 очков за 7 минут, отвечая на вопросы любых категорий, на каждый вопрос дается 20 секунд. Если Вы выбрали вопрос, но не стали на него отвечать, то он приравнивается к \"использованным\" вопросам и к нему уже нельзя будет потом вернуться. Если на вопрос дан неверный ответ, то к нему также нельзя будет вернуться. При попытке обновления страницы игра будет завершена. Удачи!!!", 0);'>Начать игру</button>
<div id="description">
<p><i id ='swim_text'></i><p>
<div id = 'entername'>
<p><i><label style='color:#8B0000;font-weight:bold;'>Ваше имя </label><input type="text" id="yourname" name="user" autofocus><input name="Submit" type=submit id="begin" value ='Далее'></i></p>
<div id='proverka' style='color:#8B0000;font-weight:bold;'></div>
</div>
</div>
<div class="rezultat" id="rezultat">
</div>
</body>
</html>