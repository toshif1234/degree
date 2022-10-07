<?php

require_once '../config.php';
$con = $link;
$sub=$_POST['sub'];
	$sem=$_POST['sem'];
	$sec=$_POST['sec'];
	$branch=$_POST['branch'];





	// Checking data by post method
	if(isset($_POST["export"])) {

		// Connect to our data base
		

		// Accept csv or text files
		header('Content-Type: text/csv; charset=utf-8');

		// Download csv file as geeksdata.csv
		header('Content-Disposition: attachment; filename=IA_marks_3.csv');
		

		// Storing data
		$output = fopen("php://output", "w");

		// Placing data using fputcsv
		fputcsv($output, array('adm_no', 'usn', 'name', 'branch', 'sem', 'sec', 'sub', '1a', '1b', '1c', '2a', '2b', '2c', '3a', '3b', '3c', '4a', '4b', '4c', 'total'));

		if($sec=="all")
		{
				// SQL query to fetch data from our table
		$query = "select adm_no,usn,name,branch,sem,sec,sub,1a,1b,1c,2a,2b,2c,3a,3b,3c,4a,4b,4c,total3 from ia_marks3 where  sem=\"" . $sem . "\" and sub=\"" . $sub . "\" and branch=\"" . $branch . "\"  ;" ;
		

		}
		else
		{
		

		
		
		// SQL query to fetch data from our table
		$query = "select adm_no,usn,name,branch,sem,sec,sub,1a,1b,1c,2a,2b,2c,3a,3b,3c,4a,4b,4c,total3 from ia_marks3 where  sem=\"" . $sem . "\" and sub=\"" . $sub . "\" and sec=\"" . $sec . "\" and branch=\"" . $branch . "\"  ;" ;
		}
		// Result
		$result = mysqli_query($con, $query);

		while($row = mysqli_fetch_assoc($result)) {

			// Fetching all rows of data one by one
			fputcsv($output, $row);
		}

		// Closing tag
		fclose($output);
	}

?>