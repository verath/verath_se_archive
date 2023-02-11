function UpdateOnline()
{
var xmlHttp;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      return false;
      }
    }
  }
  xmlHttp.onreadystatechange=function()
    {
    if(xmlHttp.readyState==4)
      {
      //document.getElementById('Posible').innerHTML=xmlHttp.responseText;
	  //alert(xmlHttp.responseText);
      }
    }
  url="http://verath.se/UpdateOnline.php"
  xmlHttp.open("GET",url,true);
  xmlHttp.send(null);
  setTimeout("UpdateOnline()",60000);
  }