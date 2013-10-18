<html>
<head>
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<meta name="description" content="UZIP is an open source URL shortening script that allows you to shorten long internet URL. Developed under R&D  Hocrox Infotech Pvt. Ltd." />
	<meta name="keywords" content="url shortener, url shortener for my website, create a url shortener, download free url shortening script, download free url shortener, free url shortner, uzip, hocrox infotech, codemink"/>
	<meta name="author" content="hocrox" />
	<link rel="image_src" href="img/logoFB.png" />
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	<title>UZIP: An Open Source URL Shortener</title>
	<style type="text/css">
		table.gridtable {
			font-family: verdana,arial,sans-serif;
			font-size:11px;
			color:#333333;
			border-width: 1px;
			border-color: #666666;
			border-collapse: collapse;
		}
		table.gridtable th {
			border-width: 1px;
			padding: 8px;
			border-style: solid;
			border-color: #666666;
			background-color: #dedede;
		}
		table.gridtable td {
			border-width: 1px;
			padding: 8px;
			border-style: solid;
			border-color: #666666;
			background-color: #ffffff;
		}
	</style>
</head>

<body>
	<div id="container">
			<div style="text-align:center;padding-top:10px;" id="header">
				<div style="margin-top:65px;" id="logo">
					<img style="" src="gfx/logo.png" />
				</div>
			</div>
			
			<div style="height:242px;">
			<div style="background:#4617B4;padding-top:15px;padding-bottom:10px;margin-top:45px;padding-left:20px;color:#FFF;text-align:center;" id="main-content">
				<?php
					if(isset($_POST['submit']))
					{
						include('config.php');
						$shorturl = basename($_POST['shorturl']);
						$comm = "select * from links where shortcode = '$shorturl'";
						$result = mysql_query($comm,$conn);
						$row = mysql_fetch_assoc ($result);
						if(is_array($row) && !empty($row))
						{
				?>
							<table style="margin-bottom:20px;" align="center" class="gridtable">
								<tr>
									<th>Short URL</th>
									<td>uzip.tk/<?php echo $row['shortcode']; ?></td>						
								<tr>
								<tr>
									<th>Date & Time of Creation</th>
									<td><?php echo $row['datetime']; ?></td>						
								<tr>
								<tr>
									<th>Corrosponding Long URL</th>
									<td><?php echo $row['long_url']; ?></td>						
								<tr>
								<tr>
									<th>Created from IP</th>
									<td><?php echo $row['ipadd']; ?></td>						
								<tr>
								<tr>
									<th>No. of times Visited</th>
									<td><?php echo $row['count']; ?></td>						
								<tr>
							</table>
					<?php }
					else
					{
						echo "<span style='color:yellow;'>uzip.tk/".$shorturl."</span> - No such short URL exist in our Database. Contact info@uzip.tk<br /><br />";
					}
				} ?>
				<form action="track.php" method="post">
					<span style="margin-right:20px;">Enter short URL generated from UZIP: </span>
					<input style="margin-right:20px;" class="retroinput" type="text" name="shorturl">
					<input style="font-size:16px;height:28px;width:100px;" name="submit" type="submit" class="retrobutton">
				</form>
			</div>	
			</div>
			
			<?php include('footer.php'); ?>
	</div>
</body>

</html>