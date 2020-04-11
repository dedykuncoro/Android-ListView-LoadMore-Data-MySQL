<?php
	include_once "koneksi.php";

	// lets find out how many rows are in the MySQL table
	$sql = "SELECT COUNT(*) FROM news";
	$result = mysqli_query($con, $sql);
	$r = mysqli_fetch_row($result);
	$numrows = $r[0];

	// find out total results
	$totalresults = $numrows;

	// number of rows to show per page
	$rowsperpage = 20;

	// find out total pages
	$totalpages = ceil($numrows / $rowsperpage);

	// get the current page or set a default
	if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
		$currentpage = (int) $_GET['currentpage'];
	} else {
		$currentpage = 1;  // default page number
	}

	// if current page is greater than total pages
	if ($currentpage > $totalpages) {
		// set current page to last page
		$currentpage = $totalpages;
	}

	// if current page is less than first page
	if ($currentpage < 1) {
		// set current page to first page
		$currentpage = 1;
	}

	// the offset of the list, based on current page
	$offset = ($currentpage - 1) * $rowsperpage;

	// get the info from the MySQL database
	$sql = "SELECT * FROM news ORDER BY ID DESC LIMIT $offset, $rowsperpage";
	$result = mysqli_query($con, $sql);

	$json = '{
		"page": '.$currentpage.',
	  	"total_results": '.$totalresults.',
	  	"total_pages": '.$totalpages.',
	  	"results": [';

	while ($row = mysqli_fetch_array($result)){
		$char ='"';
		$tgl = date("d M Y", strtotime($row['date']));
		$string = substr(strip_tags($row['value']), 0, 200);
		$json .= '{
			"id": "'.str_replace($char,'`',strip_tags($row['id'])).'", 
			"judul": "'.str_replace($char,'`',strip_tags($row['title'])).'",
			"tgl": "'.str_replace($char,'`',strip_tags($tgl)).'", 
			"isi": "'.str_replace($char,'`', $string." ...").'",
			"gambar": "'.str_replace($char,'`',strip_tags($row['images'])).'"
		},';
	}

	$json = substr($json,0,strlen($json)-1);

	$json .= ']}';

	echo $json;

	mysqli_close($con);

?>