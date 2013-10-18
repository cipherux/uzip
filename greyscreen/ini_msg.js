$(function(){
var pop = function(){
	window.scrollTo(0, 0);
	$('#screen').css({	"display": "block", opacity: 0.7, "width":$(document).width(),"height":$(document).height()});
	$('body').css({"overflow":"hidden"});
	$('#box').css({"display": "block"});
	
	full_name = document.getElementById('full_name').value;
	full_address = document.getElementById('full_address').value;
	phoneNO = document.getElementById('phoneNO').value;
	emailID = document.getElementById('emailID').value;
	message = document.getElementById('message').value;
	
	$.ajax({
		type: "POST",
		url: "send_message.php",
		data: "full_name="+full_name+"&full_address="+full_address+"&phoneNO="+phoneNO+"&emailID="+emailID+"&message="+message,
		success: function(data){
				finaldata = data;
				finaldata = '<div style="margin-top:-60px;">'+finaldata+'</div>'+ '<input onclick="closeb();" id="closebox" style="font-size:14px;font-family:lucida sans unicode,lucida grande,sans-serif;color:#FFF;border:none;background:#FFA100;width:auto;padding-left:8px;padding-right:8px;margin-top:10px;" value="OK. Thanks" type="button" /> ';
				document.getElementById('innerMSG').innerHTML = finaldata;
				
				output = data.toString();
				if(output == '<img src="greyscreen/success.png" style="width:15px;height:15px;" /> Your message has been successfully sent. One of our representative will call you soon.')
				{
					document.getElementById('full_name').value = "";
					document.getElementById('full_address').value = "";
					document.getElementById('phoneNO').value = "";
					document.getElementById('emailID').value= "";
					document.getElementById('message').value= "";
				}
			}
	});
	
}

$('#button').click(pop);
});

function closeb()
{
	$('#box').css("display", "none");
	$('#screen').css("display", "none");
	$('body').css("overflow", "auto");
	document.getElementById('innerMSG').innerHTML ='Sending request to the Server. Please wait..<br /><br />	<img src="greyscreen/loader.gif" />';
}

/*
.click(function(){$(this).css("display", "none");$('#screen').css("display", "none")})

*/