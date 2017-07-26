<?php
	// include "koneksi.php";
	// sleep(2);
	// $offset = isset($_GET['offset']) && $_GET['offset'] != '' ? $_GET['offset'] : 0;
	// $all = mysql_query("SELECT * FROM news ORDER BY id DESC");
	// $count_all = mysql_num_rows($all);
	// $query = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT $offset,10");
	// $count = mysql_num_rows($query);
	// $json_kosong = 0;
	// if($count<10){
	// 	if($count==0){
	// 		$json_kosong = 1;
	// 	}else{
	// 		$query = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT $offset,$count");
	// 		$count = mysql_num_rows($query);
	// 		if(empty($count)){
	// 			$query = mysql_query("SELECT * FROM news ORDER BY id DESC LIMIT 0,10");
	// 			$num = 0;
	// 		}else{
	// 			$num = $offset;
	// 		}
	// 	}
	// } else{
	// 	$num = $offset;
	// }
	// $json = '[';
	// while ($row = mysql_fetch_array($query)){
	// 	$num++;
	// 	$char ='"';
	// 	$tgl	= date("d M Y", strtotime($row['date']));
	// 	$string = substr(strip_tags($row['value']), 0, 200);
	// 	$json .= '{
	// 		"no": '.$num.',
	// 		"id": "'.str_replace($char,'`',strip_tags($row['id'])).'", 
	// 		"judul": "'.str_replace($char,'`',strip_tags($row['title'])).'",
	// 		"tgl": "'.str_replace($char,'`',strip_tags($tgl)).'", 
	// 		"isi": "'.str_replace($char,'`', $string." ...").'",
	// 		"gambar": "'.str_replace($char,'`',strip_tags($row['images'])).'"},';
	// }
	// $json = substr($json,0,strlen($json)-1);
	// if($json_kosong==1){
	// 	$json = '[{ "no": "", "id": "", "judul": "", "tgl": "", "isi": "", "gambar": ""}]';
	// }else{
	// 	$json .= ']';
	// }
	// echo $json;
	// mysql_close($connect);

	include_once "koneksi.php";
	sleep(2);
	$offset = isset($_GET['offset']) && $_GET['offset'] != '' ? $_GET['offset'] : 0;
	$all = mysqli_query($con, "SELECT * FROM news ORDER BY id DESC");
	$count_all = mysqli_num_rows($all);
	$query = mysqli_query($con, "SELECT * FROM news ORDER BY id DESC LIMIT $offset,10");
	$count = mysqli_num_rows($query);
	$json_kosong = 0;
	if($count<10){
		if($count==0){
			$json_kosong = 1;
		}else{
			$query = mysqli_query($con, "SELECT * FROM news ORDER BY id DESC LIMIT $offset,$count");
			$count = mysqli_num_rows($query);
			if(empty($count)){
				$query = mysqli_query($con, "SELECT * FROM news ORDER BY id DESC LIMIT 0,10");
				$num = 0;
			}else{
				$num = $offset;
			}
		}
	} else{
		$num = $offset;
	}
	$json = '[';
	while ($row = mysqli_fetch_array($query)){
		$num++;
		$char ='"';
		$tgl	= date("d M Y", strtotime($row['date']));
		$string = substr(strip_tags($row['value']), 0, 200);
		$json .= '{
			"no": '.$num.',
			"id": "'.str_replace($char,'`',strip_tags($row['id'])).'", 
			"judul": "'.str_replace($char,'`',strip_tags($row['title'])).'",
			"tgl": "'.str_replace($char,'`',strip_tags($tgl)).'", 
			"isi": "'.str_replace($char,'`', $string." ...").'",
			"gambar": "'.str_replace($char,'`',strip_tags($row['images'])).'"},';
	}
	$json = substr($json,0,strlen($json)-1);
	if($json_kosong==1){
		$json = '[{ "no": "", "id": "", "judul": "", "tgl": "", "isi": "", "gambar": ""}]';
	}else{
		$json .= ']';
	}
	echo $json;
	mysqli_close($con);

?>