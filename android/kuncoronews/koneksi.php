<?php
	$server		= "localhost"; //sesuaikan dengan nama server
	$user		= "root"; //sesuaikan username
	$password	= "enter"; //sesuaikan password
	$database	= "kuncoro_news"; //sesuaikan target databese
	
	// $connect = mysql_connect($server, $user, $password) or die ("Koneksi gagal!");
	// mysql_select_db($database) or die ("Database belum siap!");

	$con = mysqli_connect($server, $user, $password, $database);
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

?>