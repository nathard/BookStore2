function Display_Hide(displayForm,hideForm)//toggle form
{
    var x = document.getElementById(displayForm);
	var y = document.getElementById(hideForm);
    if(x.style.display == "block")
	{
		x.style.display = "none";
		y.style.display = "block"
	}else{
		x.style.display = "block";
		y.style.display = "none";
	}
		
	
}