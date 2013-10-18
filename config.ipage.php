<?php

$conn = mysql_connect("lavneet.ipagemysql.com","cipherux","pass@#123")
or die("Could not connect to the server.");

mysql_select_db("uzip",$conn)
or die("Could not select the database.");
?>