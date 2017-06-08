$(document).ready(function() {
var rezultat = 0;
var stroka = $('#nowplay').text().split(': ');
var gamer = stroka[1];
var width1 = 0;
var width22 ;
var jia = 0;
var tm;
var id;
var wrong_answers=0;
$('#nachalo').width();
$('#nowplay').show();
$('#nowplay').addClass("rezultat");
$('#end').show();
$('#header').show();
$('#stat').css({"color": "#08088A"});
setInterval(timeGame,500);
function timeGame() {
    $('#showbegin').animate({'margin-top': '30px'},1000).animate({'margin-top': '10px'},1000);
}
setInterval(timeGame1,500);
function timeGame1() {
    $('#showend').animate({'margin-top': '10px'},1000).animate({'margin-top': '30px'},1000);
}

function progress(tm,id,widthx) {
    $(id).animate({width: widthx+tm+'px'});
}
for (tm=0;tm<515;tm=tm+0.5) {
    setInterval(progress(tm,'#progress',width1),1000);
}
setTimeout(function() {
    $.ajax({
    type: "POST",
    url: "end.php",
    data: {user:gamer},
    success: function(msg){
    
    location.replace("gameover.php?user=" + gamer + "&score=" + msg);
    
    }
});

},420000);


setInterval(spectrum,1000);
function spectrum() {
        $('#stat:not(.zagolovok)').animate({ color:'#FF0040'},500).animate({ color:'#08088A'},500);}
$('#block1').slideDown("slow");
$('#end').click(function(){
$.ajax({
      type: "POST",
      url: "end.php",
      data: {user:gamer},
      success: function(msg){
	location.replace("gameover.php?user=" + gamer + "&score=" + msg);
    }
});

});

function answerMe(value1,value2,value3) {
    $.ajax({
      type: "POST",
      url: "answer.php",
      data: {answer:value1, table:value2},
      success: function(msg){
        var dat = msg;
        if (dat != 0) {
            if (dat > 4) {
		swal("Вы заработали " + dat + " очков");
		$('#btn23').click(function(){
		    $('#alert').hide();
		});
    		rezultat = parseInt(rezultat) + parseInt(dat);
		value3.fadeTo(0, 1);
    		value3.css({"background-color":"#42F009"});
		$('#rezultat').show().html("<p>Счет: "+rezultat +" очк</p>");
		if (rezultat >= 80) {
		    swal('ВЫ - ПОБЕДИТЕЛЬ!!!');
		    location.replace("gameover.php?user=" + gamer + "&score=" + rezultat);
		}
            }
            else  {
                swal("Вы заработали " + dat + " очка");
                rezultat = parseInt(rezultat) + parseInt(dat);
                value3.fadeTo(0, 1);
                value3.css({"background-color":"#42F009"});
                $('#rezultat').show().html("<p>Счет: "+rezultat +" очк</p>");
            }
	    
	     $.ajax({
	    type: "POST",
	    url: "addScore.php",
	    data: {score:rezultat, user:gamer},
	    });
        }
       else {
        	swal("Ответ неправильный!!!!");
		wrong_answers = parseInt(wrong_answers) + 1;
		check_count_WA(wrong_answers);
        	value3.fadeTo(0, 1);
        	value3.css({"background-color":"#FF0000"}); 
	}
     }
    });
}

$('#block1 td:not(:eq(0),:eq(6),:eq(12),:eq(18),:eq(24),:eq(30),:eq(36),:eq(42))').hover(
    function(){
	$(this).siblings('.punkt2').fadeTo(0,0.7);
    },function(){
	$(this).siblings('.punkt2').fadeTo(0,1);
});
function check_count_WA(wrong_answers) {
    if (wrong_answers == 3) {
	swal('Вы неверно ответили на 3 вопроса!!!');
	location.replace("gameover.php?user=" + gamer + "&score=" + rezultat);
    }
}
$(function() {
$('#block1 td:not(:eq(0),:eq(6),:eq(12),:eq(18),:eq(24),:eq(30),:eq(36),:eq(42))').bind('click', chooseTD);
var usedTD = ['0','6','12','18','24','30','36','42'];

function chooseTD(e) {
$('#youranswer').val("");
$(this).css({"background-color":"#FF0000"});
now = $(this).siblings().attr('id');
need = $(this).text();
rez = $(this);

$.ajax({
  type: "POST",
    url: "question.php",
    data: {table:now, score:need},
    success: function(msg){
	$('#answer').show();
	$('#answer p').text(msg);
	usedTD.push($('#block1 td').index(rez));
	$('#block1 td').unbind('click',chooseTD);
	width22 = 0;
	$('#time1').text('Секунды бегут...');
	$('#time1').css({'background-color': '#7CFC00','width':'0px'});
	for (tm=0;tm<340;tm=tm+6.5) {
	    setInterval(progress(tm,'#time1',width22),10000);
	}
	id = setTimeout(frame,20000);
	function frame() {
		clearTimeout(id);
		wrong_answers = parseInt(wrong_answers) + 1;
		swal('Время истекло!');
		check_count_WA(wrong_answers);
		$('#answer').hide();
		$('#time1').text('');
		next();
	}
}
});
}
	function next() {
	    $('#block1 td').bind('click',chooseTD);
	    $.each(usedTD, function(index,value) {
	    $('#block1 td:eq('+value+')').unbind('click',chooseTD);
	    });
	}
	$('#button2').click(function(){
	    clearTimeout(id);
	    $('#time1').text('');
	    var now1 = now;
	    var rez1 = rez;
	    now='';
	    rez = '';
	    var answer = $('#youranswer').val();
	    $('#answer').hide();
	    $('#block1 td').bind('click',chooseTD);
	    $.each(usedTD, function(index,value) {
	    $('#block1 td:eq('+value+')').unbind('click',chooseTD);
	    });
	    if (answer == '') {
		swal('Вы не ответили на вопрос!!!');
		wrong_answers = parseInt(wrong_answers) + 1;
		check_count_WA(wrong_answers);
		rez.fadeTo(0, 1);
		rez.css({"background-color":"#FF0000"});
		
	    }
	    else {
		return answerMe(answer,now1,rez1);
		now1='';
		rez='';
	    }
	
	    

	});

});
});