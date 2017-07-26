<?php
	// include "koneksi.php";

	// $id = $_POST['id'];
	// $query = mysql_query("SELECT * FROM news WHERE id='".$id."'");
	// while ($row = mysql_fetch_array($query)){
	// 	$char ='"';
	// 	$tgl	= date("d M Y", strtotime($row['date']));
	// 	$string = $row['value'];
	// 	$json = '{
	// 			"id": "'.str_replace($char,'`',strip_tags($row['id'])).'", 
	// 			"judul": "'.str_replace($char,'`',strip_tags($row['title'])).'",
	// 			"tgl": "'.str_replace($char,'`',strip_tags($tgl)).'", 
	// 			"isi": "'.str_replace($char,'`', $string).'",
	// 			"gambar": "'.$row['images'].'"}';
	// }
	// echo $json;
	// mysql_close($connect);

	include_once "koneksi.php";
	$id = $_POST['id'];
	$query = mysqli_query($con, "SELECT * FROM news WHERE id='".$id."'");
	while ($row = mysqli_fetch_array($query)){
		$char = '"';
		$tgl = date("d M Y", strtotime($row['date']));
		$string = $row['value'];
		$json = '{
				"id": "'.str_replace($char,'`',strip_tags($row['id'])).'", 
				"judul": "'.str_replace($char,'`',strip_tags($row['title'])).'",
				"tgl": "'.str_replace($char,'`',strip_tags($tgl)).'", 
				"isi": "'.str_replace($char,'`', $string).'",
				"gambar": "'.$row['images'].'"}';
	}
	echo $json;
	mysqli_close($con);
?>