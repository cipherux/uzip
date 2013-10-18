<?php 

//redirect to real link if URL is set
 if (isset($_GET['url'])) {
	$shorturl = $_GET['url'];
	include('config.php');
	$comm = "select * from links where shortcode = '$shorturl'";
	$result = mysql_query($comm,$conn);
	$row = mysql_fetch_assoc ($result);
		
	if(is_array($row) && !empty($row))
	{
		$visits = intval($row['count']);
		$redirect = $row['long_url'];
		$uptilnow = $visits + 1;
		$updatecomm = "update links set count=".$uptilnow." where shortcode='$shorturl'";
		$updateres = mysql_query($updatecomm,$conn);
		if($updateres)
		{
			header('HTTP/1.1 301 Moved Permanently');
			header('Cache-Control: no-store, no-cache, must-revalidate');
			header("Location: ".$redirect);
		}
		else
		{
			echo "Server Error.!";
			exit(0);
		}
	}
 }
//

?>

<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="js/script.js"></script>
	<!-- screen grey out -->
	<link rel="stylesheet" href="greyscreen/ini.css"/>
	<script type="text/javascript" src="greyscreen/ini.js"></script>
	<meta name="description" content="UZIP is an open source URL shortening script that allows you to shorten long internet URL. Developed under R&D  Hocrox Infotech Pvt. Ltd." />
	<meta name="keywords" content="url shortener, url shortener for my website, create a url shortener, download free url shortening script, download free url shortener, free url shortner, uzip, hocrox infotech, codemink"/>
	<meta name="author" content="hocrox" />
	<link rel="image_src" href="img/logoFB.png" />
	<title>UZIP: An Open Source URL Shortener</title>
</head>

<body>
	<div id="container">
			<div style="text-align:center;padding-top:10px;" id="header">
				<div style="margin-top:65px;" id="logo">
					<img style="" src="gfx/logo.png" />
				</div>
			</div>
			
			<div style="background:#4617B4;padding-top:15px;padding-bottom:10px;margin-top:45px;text-align:center;" id="main-content">
				<form id="uzipform" method="post" action="shorturl.php">
					<div style="color:#FFF;font-size:28px;margin-bottom:20px;">
						Paste or Type the long URL below
					</div>
					<div>
						<input autocomplete = "off" id="longurl" name="longurl" spellcheck="false" type="text" class="metroinput" />
					</div>
					<div style="margin-top:30px;">
						<input type="submit" class="retrobutton" value="Zip it !" />
					</div>
				</form>
			</div>
			
			<div id="box">
			<div id="innerMSG" style="margin-top:70px;">
			Sending request to the Server. Please wait..<br /><br />
			<img src="greyscreen/loader.gif" />
			</div>
			</div>
		
			<div id="screen">
			</div>
			
			<?php include('footer.php'); ?>
	</div>
</body>

</html>