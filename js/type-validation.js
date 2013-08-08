//input number only
function numbersonly(myevent, decimal) {
var key;
var keychar;

if (window.event) {
   key = window.event.keyCode;
}
else if (myevent) {
   key = myevent.which;
}
else {
   return true;
}
keychar = String.fromCharCode(key);

if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
   return true;
}
else if ((("0123456789").indexOf(keychar) > -1)) {
   return true;
}
else if (decimal && (keychar == ".")) { 
  return true;
}
else
   return false;
}

function show_alert(value)
{
alert("You have no items in your cart");
}
//take form effect
function effect_in_textbox(textboxID,DefaultValue){
	if (document.getElementById(textboxID).value == DefaultValue)
		document.getElementById(textboxID).value ="";
}