$(function(){
var pop = function(){
	window.scrollTo(0, 0);
	$('#screen').css({	"display": "block", opacity: 0.7, "width":$(document).width(),"height":$(document).height()});
	$('body').css({"overflow":"hidden"});
	$('#box').css({"display": "block"});
	
	full_name = document.getElementById('full_name').value;
	enroll_in = document.getElementById('enroll_in').value;
	phone = document.getElementById('phone').value;
	email = document.getElementById('email').value;
	timings = document.getElementById('timings').value;
	message = document.getElementById('message').value;
	
	$.ajax({
		type: "POST",
		url: "enroll_code.php",
		data: "full_name="+full_name+"&enroll_in="+enroll_in+"&phone="+phone+"&email="+email+"&timings="+timings+"&message="+message,
		success: function(data){
				finaldata = data;
				finaldata = '<div style="margin-top:-20px;">'+finaldata+'</div>'+ '<input onclick="closeb();" id="closebox" style="font-size:14px;font-family:lucida sans unicode,lucida grande,sans-serif;color:#FFF;border:none;background:#FFA100;width:auto;padding-left:8px;padding-right:8px;margin-top:10px;" value="OK. Thanks" type="button" /> ';
				document.getElementById('innerMSG').innerHTML = finaldata;
				
				output = data.toString();
				if(output == '<img src="greyscreen/success.png" style="width:15px;height:15px;" /> Your request has been successfully sent. One of our representative will call you soon.')
				{
					document.getElementById('full_name').value = "";
					document.getElementById('phone').value = "";
					document.getElementById('email').value = "";
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