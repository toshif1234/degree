<?php

require_once "../config.php";
$con = $link;

    session_start();
	$faculty_dept=$_POST['faculty_dept'];
	





	// Checking data by post method
	if(isset($_POST["export"])) {

		// Connect to our data base
		

		// Accept csv or text files
		header('Content-Type: text/csv; charset=utf-8');

		// Download csv file as geeksdata.csv
		header('Content-Disposition: attachment; filename=faculty_data.csv');
		

		// Storing data
		$output = fopen("php://output", "w");

		// Placing data using fputcsv
		fputcsv($output, array('faculty_id', 'faculty_name', 'faculty_desg', 'faculty_dept', 'faculty_qulfy', 'faculty_yoj', 'faculty_dob', 'faculty_email', 'faculty_contact', 'faculty_parmenent_address', 'faculty_present_address', 'faculty_teaching_exp', 'faculty_industry_exp', 'faculty_aicte_id', 'faculty_ug_dept', 'faculty_ug_year', 'faculty_ug_college', 'faculty_pg_dept', 'faculty_pg_year', 'faculty_pg_college', 'faculty_phd_reg', 'faculty_phd_status', 'faculty_phd_guide', 'faculty_phd_topic', 'faculty_phd_domain', 'faculty_phd_center', 'faculty_phd_yoj', 'faculty_phd_complition', 'faculty_sub_handel'));

		if($faculty_dept=="all")
		{
				// SQL query to fetch data from our table
		$query = "SELECT * FROM faculty_details WHERE 1;" ;
		

		}
		else
		{
		

		
		
		// SQL query to fetch data from our table
		$query = "SELECT * FROM faculty_details WHERE faculty_dept=\"" .$faculty_dept . "\" ;" ;
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