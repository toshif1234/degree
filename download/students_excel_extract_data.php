<?php
require_once "../config.php";
$con = $link;
	$batch=$_POST['batch'];
	$sem=$_POST['sem'];
	$sec=$_POST['sec'];
	$branch=$_POST['branch'];





	// Checking data by post method
	if(isset($_POST["export"])) {

		// Connect to our data base
		

		// Accept csv or text files
		header('Content-Type: text/csv; charset=utf-8');

		// Download csv file as geeksdata.csv
		header('Content-Disposition: attachment; filename=Students_data.csv');
		

		// Storing data
		$output = fopen("php://output", "w");

		// Placing data using fputcsv
		fputcsv($output, array('adm_no', 'usn', 'batch', 'semester', 'section', 'fname', 'mname', 'lname', 'branch', 'kcet', 'comedk', 'jee', 'nationality', 'data_of_admission', 'dob', 'place_of_birth', 'gender', 'mob_no', 'email_id', 'aadhar', 'pan_card', 'sc_st', 'caste', 'annual_income', 'present_state', 'present_dist', 'present_house_no_name', 'present_post_village', 'present_pincode', 'permanent_state', 'permanent_dist', 'permanent_house_no_name', 'permanent_post_village', 'permanent_pin_code','sslc_school', 'sslc_board_university', 'sslc_reg_no', 'sslc_year', 'sslc_max_marks', 'sslc_obtained_marks', 'sslc_percentage', 'puc_school', 'puc_board_university', 'puc_reg_no', 'puc_year', 'puc_max_marks', 'puc_obtained_marks', 'puc_percentage', 'puc_phy_max_marks', 'puc_phy_obtained_marks', 'puc_maths_max_marks', 'puc_maths_obtained_marks', 'puc_che_max_marks', 'puc_che_obtained_marks', 'puc_elective_max_marks', 'puc_elective_obtained_marks', 'puc_sub_total_marks', 'puc_eng_max_marks', 'puc_eng_obtained_marks', 'mother_name', 'mother_mob_no', 'mother_email_id', 'mother_aadhar', 'mother_pan_card', 'mother_occupation', 'father_name', 'father_mob_no', 'father_email_id', 'father_aadhar', 'father_pan_cad', 'father_occupation'));

		if($sec=="all")
		{
				// SQL query to fetch data from our table
		$query = "select s.adm_no,s.usn,s.batch,s.semester,s.section,s.fname,s.mname,s.lname,s.branch,s.kcet,s.comedk,s.jee,s.nationality,s.data_of_admission,s.dob,s.place_of_birth,s.gender,s.mob_no,s.email_id,s.aadhar,s.pan_card,s.sc_st,s.caste,s.annual_income,s.present_state,s.present_dist,s.present_house_no_name,s.present_post_village,s.present_pincode,s.permanent_state,s.permanent_dist,s.permanent_house_no_name,s.permanent_post_village,s.permanent_pin_code,sl.sslc_school,sl.sslc_board_university,sl.sslc_reg_no,sl.sslc_year,sl.sslc_max_marks,sl.sslc_obtained_marks,sl.sslc_percentage,pu.puc_school,pu.puc_board_university,pu.puc_reg_no,pu.puc_year,pu.puc_max_marks,pu.puc_obtained_marks,pu.puc_percentage,pu.puc_phy_max_marks,pu.puc_phy_obtained_marks,pu.puc_maths_max_marks,pu.puc_maths_obtained_marks,pu.puc_che_max_marks,pu.puc_che_obtained_marks,pu.puc_elective_max_marks,pu.puc_elective_obtained_marks,pu.puc_sub_total_marks,pu.puc_eng_max_marks,pu.puc_eng_obtained_marks,p.mother_name,p.mother_mob_no,p.mother_email_id,p.mother_aadhar,p.mother_pan_card,p.mother_occupation,p.father_name,p.father_mob_no,p.father_email_id,p.father_aadhar,p.father_pan_cad,p.father_occupation from students s,parents_details p,puc_details pu,sslc_details sl where s.adm_no=p.adm_no and s.adm_no=pu.adm_no and s.adm_no=sl.adm_no and batch=\"" . $batch . "\" and semester=\"" . $sem . "\" and branch=\"" . $branch . "\" ;" ;
		

		}
		else
		{
		

		
		
		// SQL query to fetch data from our table
		$query = "select s.adm_no,s.usn,s.batch,s.semester,s.section,s.fname,s.mname,s.lname,s.branch,s.kcet,s.comedk,s.jee,s.nationality,s.data_of_admission,s.dob,s.place_of_birth,s.gender,s.mob_no,s.email_id,s.aadhar,s.pan_card,s.sc_st,s.caste,s.annual_income,s.present_state,s.present_dist,s.present_house_no_name,s.present_post_village,s.present_pincode,s.permanent_state,s.permanent_dist,s.permanent_house_no_name,s.permanent_post_village,s.permanent_pin_code,sl.sslc_school,sl.sslc_board_university,sl.sslc_reg_no,sl.sslc_year,sl.sslc_max_marks,sl.sslc_obtained_marks,sl.sslc_percentage,pu.puc_school,pu.puc_board_university,pu.puc_reg_no,pu.puc_year,pu.puc_max_marks,pu.puc_obtained_marks,pu.puc_percentage,pu.puc_phy_max_marks,pu.puc_phy_obtained_marks,pu.puc_maths_max_marks,pu.puc_maths_obtained_marks,pu.puc_che_max_marks,pu.puc_che_obtained_marks,pu.puc_elective_max_marks,pu.puc_elective_obtained_marks,pu.puc_sub_total_marks,pu.puc_eng_max_marks,pu.puc_eng_obtained_marks,p.mother_name,p.mother_mob_no,p.mother_email_id,p.mother_aadhar,p.mother_pan_card,p.mother_occupation,p.father_name,p.father_mob_no,p.father_email_id,p.father_aadhar,p.father_pan_cad,p.father_occupation from students s,parents_details p,puc_details pu,sslc_details sl where s.adm_no=p.adm_no and s.adm_no=pu.adm_no and s.adm_no=sl.adm_no and batch=\"" . $batch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\" and branch=\"" . $branch . "\" ;" ;
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