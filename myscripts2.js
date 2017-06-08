$(document).ready(function() {
$('#yourname').val("");
$('#privet').fadeIn(1000);
$('#begin1').fadeIn(3000);
var colors = ['#F7FE2E','#FF0000','#00FFFF','#00FFFF','#00FF00','#9F81F7','#0000FF'];
var reg1 = /^\d+$/;
var reg = /^[0-9a-zа-я]+$/i;
setInterval(rainbow,1000);
function rainbow() {
    for (var i =0; i<colors.length; i++) {
	$('#begin1').animate({'background-color': colors[i]},1000);
    }
}
setInterval(spectrum10,1000);
function spectrum10() {
    $('#privet').animate({'left':'50px','color':'#088A08'},5000).animate({'left':'-50px','color':'#8B0000'},5000);
}


$('#begin').click(function(){
    var gamer = $('#yourname').val();
    if (gamer == '') {
	$('#proverka').text('Введите имя!!!');
	$('#yourname').addClass('border');
    }
    else {
	if (gamer.length>10 ||  gamer.length<4 ) {
	    $('#proverka').text('Имя не должно быть больше 10 символов и меньше 4!!!');
	    $('#yourname').addClass('border');
	}
	else if (reg.test(gamer)) {
	    
    	    $.ajax({
    		type: "POST",
    		url: "addUser.php",
		data: {user:gamer},
		success: function(msg){
	    	    if (msg == 'notadded') {
			$('#proverka').text('Такой игрок уже существует!!!');
			$('#yourname').addClass('border');
		    }
		    else { 
			location.replace("game.php?gamer=" + gamer);

			$('#yourname').removeClass('border');
		    }
	    }

	    });		
	}
    
	else { 
	    $('#proverka').text('Имя должно содержать буквы и цифры!!!');
	    $('#yourname').addClass('border');
	}
    }
});
         $('#privet').addClass("rezultat").text("Сейчас играет: " + gamer);
         $('#end').show();
         $('#header').hide();
    setTimeout(function(){
                 $('#header').show(); setInterval(function(){
                                             $("#header").toggle();},500)},1000);
    
    $('#description').slideUp();
    $('#block1').slideDown("slow");
$('#end').click(function(){
    $.ajax({
    type: "POST",
        url: "end.php",
        data: {user:gamer, count:rezultat},
	success: function(msg){
	    alert(msg);
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
        	alert("Вы заработали " + dat + " очков");
        	rezultat = parseInt(rezultat) + parseInt(dat);
        	value3.fadeTo(0, 1);
        	value3.css({"background-color":"#42F009"});
        	$('#rezultat').show().html("<p>" + gamer +", у Вас "+rezultat +" очк</p>");
        	
        	
            }
            else  {
                alert("Вы заработали " + dat + " очка");
                rezultat = parseInt(rezultat) + parseInt(dat);
                value3.fadeTo(0, 1);
                value3.css({"background-color":"#42F009"});
                $('#rezultat').show().html("<p>"+gamer+", у Вас "+rezultat +" очк</p>");
                }
        }
       else {
            alert("Ответ неправильный!!!!");
            value3.fadeTo(0, 1);
            value3.css({"background-color":"#FF0000"});
      }
      
     }
    });
}
$('td').hover(
    function(){ 
	$(this).css({"background-color":"#FF0000"});
                 // навели курсор на объект
    },function(){
	$(this).css({"background-color":"#00BFFF"});
});
$(function() {
$('#block1 td:not(:eq(0),:eq(6),:eq(12),:eq(18),:eq(24),:eq(30),:eq(36),:eq(42))').bind('click', chooseTD);
var usedTD = ['0','6','12','18','24','30','36','42'];

function chooseTD(e) {
$('#youranswer').val("");
$(this).fadeTo(0, 0.5).css({"background-color":"#FF0000"});
now = $(this).siblings().attr('id');
need = $(this).text();
rez = $(this);
button = false;


$.ajax({
  type: "POST",
    url: "question.php",
    data: {table:now, score:need},
    success: function(msg){
	var width = 29;
	$('#time1').text('Осталось 30с');
	var id = setInterval(frame,1000);
	
	
	$('#answer').show();
	$('#answer p').text(msg);
	usedTD.push($('td').index(rez));
	$('td').unbind('click',chooseTD);
	function frame() {
	    if (width == 0) {
	        clearInterval(id);
		alert('Время истекло!');
		$('#answer').hide();
		$('#time1').text('');
		next();
		return false;
	    } else {
		
		$('#time1').text('Осталось ' + width + 'с');
		if (button == true) {clearInterval(id); $('#time1').text('');return false;}
		width --;
	    }
	}


}	
});
}
	function next() {
	    $('td').bind('click',chooseTD);
	    $.each(usedTD, function(index,value) {
	    $('td:eq('+value+')').unbind('click',chooseTD);
	    });

	    }
	$('#button2').click(function(){
	    button = true;
	
	    var now1 = now;
	    var rez1 = rez;
	
	    now='';
	    rez = '';
	    var answer = $('#youranswer').val();
	    $('#answer').hide();
	    $('td').bind('click',chooseTD);
	    $.each(usedTD, function(index,value) {
	    $('td:eq('+value+')').unbind('click',chooseTD);
	    });
	    if (answer == '') {
		alert('Вы не ответили на вопрос!');
		rez.fadeTo(0, 1);
		rez.css({"background-color":"#FF0000"});
		
	    }
	    else {
		return answerMe(answer,now1,rez1);
		now1='';
		rez='';
		
	    }
	
	return button;

	    });



});
});