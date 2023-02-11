function UpdateInfo()
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
	  	if(xmlHttp.responseText=="yes")
	  	{
			document.getElementById('msgPic').src='http://verath.se/pics/menuTop/NyaMeddelanden.png';
			document.getElementById('msgLink').href='http://verath.se/msg?action=read&id=0';
		}else
		{
			document.getElementById('msgPic').src='http://verath.se/pics/menuTop/Meddelanden.png';
			document.getElementById('msgLink').href='http://verath.se/msg';	
		}
      }
    }
  url="http://verath.se/UpdateInfo.php"
  xmlHttp.open("GET",url,true);
  xmlHttp.send(null);
  	  setTimeout("UpdateInfo()",30000);
  }