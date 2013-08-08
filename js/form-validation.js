// validates if the input is empty and displays the error message
         function validateNotEmpty( input, id )
         {
            var errorDisplay =  document.getElementById( id );
            var notEmpty;
            if ( input == "" ) // check if input is empty
            {
               errorDisplay.innerHTML = "This is a requiered field";
               notEmpty = false; // update return value
            } // end if
            else
            {
               errorDisplay.innerHTML = ""; // clear the error area
               notEmpty = true; // update return value
            } // end else

            return notEmpty; // return whether the input is empty

         }// end function validateNotEmpty


/*-------------------Customer Details--------------------------*/
//First Name Validator
function FNameValidator(fname)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("FNameError").innerHTML=httpxml.responseText;

}
}

url="validation/fname-validation.php";
url=url+"?fname="+fname;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of First Name Validator


//Last Name Validator
function LNameValidator(lname)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("LNameError").innerHTML=httpxml.responseText;

}
}

url="validation/lname-validation.php";
url=url+"?lname="+lname;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Last Name Validator


//Phone Validator
function PhoneValidator(phone)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("PhoneError").innerHTML=httpxml.responseText;

}
}

url="validation/phone-validation.php";
url=url+"?phone="+phone;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Phone Validator


//Email Validator
function EmailValidator(email)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("MailError").innerHTML=httpxml.responseText;

}
}
var url="validation/email-validation.php";
url=url+"?email="+email;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Email Validator


//Address validator
function AddressValidator(addr)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("AddressError").innerHTML=httpxml.responseText;

}
}
var url="validation/address-validation.php";
url=url+"?addr="+addr;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Address Validator


//Post Code Validator
function PostcodeValidator(pcode)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("PcodeError").innerHTML=httpxml.responseText;

}
}
var url="validation/pcode-validation.php";
url=url+"?pcode="+pcode;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of post code validator

//City validator
function CityValidator(city)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("CityError").innerHTML=httpxml.responseText;

}
}
var url="validation/city-validation.php";
url=url+"?city="+city;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of City validator


/*------------------------Deliver form------------------------------*/
//First Name Validator
function DFNameValidator(dfname)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("DFNameError").innerHTML=httpxml.responseText;

}
}

url="validation/dfname-validation.php";
url=url+"?dfname="+dfname;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of First Name Validator


//Last Name Validator
function DLNameValidator(dlname)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("DLNameError").innerHTML=httpxml.responseText;

}
}

url="validation/dlname-validation.php";
url=url+"?dlname="+dlname;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Last Name Validator

//Deliver Post Code Validator
function DPostcodeValidator(dpcode)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("DPcodeError").innerHTML=httpxml.responseText;

}
}
var url="validation/dpcode-validation.php";
url=url+"?dpcode="+dpcode;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of deliver post code validator

//Deliver City validator
function DCityValidator(dcity)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("DCityError").innerHTML=httpxml.responseText;

}
}
var url="validation/dcity-validation.php";
url=url+"?dcity="+dcity;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of deliver City validator

//Deliver Unit Validator
function UnitValidator(unit)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("UnitError").innerHTML=httpxml.responseText;

}
}
var url="validation/unit-validation.php";
url=url+"?unit="+unit;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of deliver Unit validator

//Street Validator
function StreetValidator(st)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("StreetError").innerHTML=httpxml.responseText;

}
}
var url="validation/street-validation.php";
url=url+"?st="+st;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of deliver Street validator

/*----------------------Payment detail---------------------------*/

//Credit card validator
function CCValidator(cc)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("CCError").innerHTML=httpxml.responseText;

}
}
var url="validation/cc-validation.php";
url=url+"?cc="+cc;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//end of credit card validator

//csc validator
function CSCValidator(csc)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("CSCError").innerHTML=httpxml.responseText;

}
}
var url="validation/csc-validation.php";
url=url+"?csc="+csc;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//end of csc validator


//year validator
function yearValidator(year)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("yearError").innerHTML=httpxml.responseText;

}
}
var url="validation/year-validation.php";
url=url+"?year="+year;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//end of year validator

/*-------------------------register form---------------------------------------*/
//Username Validator
function UserNameValidator(username)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("UserNameError").innerHTML=httpxml.responseText;

}
}

url="validation/username-validation.php";
url=url+"?username="+username;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Username Validator

//Password Validator
function PasswordValidator(password)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("PasswordError").innerHTML=httpxml.responseText;

}
}

url="validation/password-validation.php";
url=url+"?password="+password;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Password Validator
/*-------------contact form-----------------*/
//Name Validator
function NameValidator(name)
{
var httpxml;
try
{
// Firefox, Opera 8.0+, Safari
httpxml=new XMLHttpRequest();
}
catch (e)
{
// Internet Explorer
try
{
httpxml=new ActiveXObject("Msxml2.XMLHTTP");
}
catch (e)
{
try
{
httpxml=new ActiveXObject("Microsoft.XMLHTTP");
}
catch (e)
{
alert("Your browser does not support AJAX!");
return false;
}
}
}
function stateck()
{
if(httpxml.readyState==4)
{
document.getElementById("NameError").innerHTML=httpxml.responseText;

}
}

url="validation/name-validation.php";
url=url+"?name="+name;
httpxml.onreadystatechange=stateck;
httpxml.open("GET",url,true);
httpxml.send(null);
}
//End of Name Validator
