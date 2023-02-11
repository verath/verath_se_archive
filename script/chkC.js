// JavaScript Document
var i=0;
var sCode = new Array("V","E","R","A","T","H","S","E"); // små bokstäver ska man skriva...

function chkC(e)
{
	var code;
	if (!e) var e = window.event;
	if (e.keyCode) code = e.keyCode;
	else if (e.which) code = e.which;
	var character = String.fromCharCode(code);
	if (character == sCode[i]){
		i++;
	}else{
		i=0;
	}
	if(i==sCode.length) alert("Tredje teckenet är:\n"+String.fromCharCode(67));
}