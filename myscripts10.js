$(document).ready(function() {
var text = 'WELCOME';
var i=0;
function animateText(text,id) {
    for (i=0; i<text.length;i++) {
    var anim = text.substr(0,i);
    $(id).text(anim);
}
}
    setTimeout(animateText(text,'#proverka'), 1000);




});