$(document).ready(function() {
    setInterval(timeGame1,1000);
    function timeGame1() {
	$('#dem').animate({'width': '250px','height':'250px'}).animate({'width': '200px','height':'200px'});
    }
    setInterval(spectrum,1000);
    function spectrum() {
        $('#how').animate({ color:'#000000'},500).animate({ color:'#FF0000'},500);}
    
    setTimeout(function(){$('#mur1').animate({'height':'600px','top':'0px'},5000).animate({'height':'0px','top':'600px'},5000);setInterval(spectrum1,9000);},500);

    function spectrum1() {
        $('#mur1').animate({'height':'0px','top':'600px'},5000).animate({'height':'600px','top':'0px'},5000);}

    setTimeout(function(){$('#mur2').animate({'height':'600px'},5000).animate({'height':'0px'},5000);setInterval(spectrum2,9000);},500);

    function spectrum2() {
        $('#mur2').animate({'height':'0px'},5000).animate({'height':'600px'},5000);}

    setTimeout(function(){ $('#mur3').animate({'width':'1400px'},4000).animate({'width':'0px'},4000);setInterval(spectrum3,10000);},7000);
    function spectrum3() {
        $('#mur3').animate({'width':'0px'},4000).animate({'width':'1400px'},4000);}
     setTimeout(function(){$('#mur4').animate({'width':'1400px','left':'0px'},4000).animate({'width':'0px','left':'1400px'},4000);setInterval(spectrum4,10000);},7000);
    function spectrum4() {
        $('#mur4').animate({'width':'0px','left':'1400px'},4000).animate({'width':'1400px','left':'0px'},4000);}

});