<?php

include('config.php');

function randomstring($length = 3) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function getRealIpAddr(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

$longurl = $_POST['longurl'];
if(!filter_var($longurl, FILTER_VALIDATE_URL))
{
	echo "<div style='margin-top:-40px;'><img style='width:20px;' src='greyscreen/error.png' /> The URL that you've entered is not valid.!<br /><br />A correct URL is that which begins with <b style='color:yellow;'>http://</b> or <b style='color:yellow;'>http://www.</b> or <b style='color:yellow;'>https://</b>, etc.</div>";
	exit(0);
}

// check if that string already exist in database or not
// the loop continous until a unqiue shortcode is not generated.
$already_exist = 1;

while($already_exist)
{
	// generate a random alphanumeric string
	$shorturl = randomstring();

	$comm = "select * from links where shortcode = '$shorturl'";
	$result = mysql_query($comm,$conn);
	$row = mysql_fetch_assoc ($result);
		
	if(is_array($row) && !empty($row))
	{
		$already_exist = 1;
		continue;
	}
	else
	{
		$already_exist = 0;
		break;
	}
}


$currentdt = date("Y-m-d H:i:s A", time());
$myip = getRealIpAddr();
$comm = "insert into links (long_url, shortcode, count, datetime, ipadd) values('$longurl', '$shorturl', 0, '$currentdt', '$myip')";
$result = mysql_query($comm,$conn);
if($result)
echo "<div style='margin-top:-40px;'><img style='width:20px;' src='greyscreen/success.png' /> Your URL has been shortened to <a style='color: yellow;text-decoration:none;' target='_blank' href='http://uzip.tk/$shorturl'>uzip.tk/<b>$shorturl</b></a><div style='margin-top:8px;'><a class='copyins' href='javascript:CopyToClipboard(\"http://uzip.tk/$shorturl\")'>Click here to Copy</a></div><div <div style='margin-top:14px;'>You can track this url at: <a target='_blank' style='color: yellow;text-decoration:none;' href='http://www.uzip.tk/track.php'>www.uzip.tk/track</a></div></div>";
else
echo "<img style='width:20px;' src='greyscreen/error.png' /> Your URL has been shortened to <a style='color: yellow;text-decoration:none;' href='http://uzip.tk/$shorturl'>http://uzip.tk/<b>$shorturl</b></a><br /><br />You can track this url at: <a style='color: yellow;text-decoration:none;' href='http://www.uzip.tk/track.php'>www.uzip.tk/track</a>";
?>