// ===================================================================
// Sim Roulette
// License: GPL v3 (http://www.gnu.org/licenses/gpl.html)
// Copyright (c) 2016-2020 Xzero Systems, http://sim-roulette.com
// Author: Nikita Zabelin
// ===================================================================

var send="";
var receive="";
var connect=0;
setInterval(function()
{
	SendRequest();
}, term_int);
function SendRequest()
{
	var Request = new XMLHttpRequest();
	Request.onreadystatechange = function()
	{
		if (Request.readyState == 4)
		{
			if (Request.responseText)
			{
				var str=Request.responseText.split("#!#");
				if (send!=str[0])
				{	
					if (str[0]){document.getElementById("result_send").innerHTML=str[0]+document.getElementById("result_send").innerHTML;}
					send=str[0];
				}
				if (receive!=str[1])
				{	
					if (str[1]){document.getElementById("result_receive").innerHTML=str[1]+document.getElementById("result_receive").innerHTML;}
					receive=str[1];	
				}	
			}
		}
	}
	Request.open("GET", 'terminal_answer.php', true);
	Request.send(null);
}