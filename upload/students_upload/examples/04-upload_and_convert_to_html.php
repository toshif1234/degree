<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../src/SimpleXLSX.php';
require_once "config1.php";



if (isset($_FILES['file'])) {
	
	if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) ) {

		echo '<h2>Successfully Imported !</h2>';
		echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

		$dim = $xlsx->dimension();
		$cols = $dim[0];

		foreach ( $xlsx->rows() as $k => $r ) {
					 // skip first row
			// print($k)
			// echo '<tr>';
			for ( $i = 0; $i < $cols; $i ++ ) {
				//echo '<td>' . ( isset( $r[ $i ] ) ? $r[ $i ] : '&nbsp;' ) . '</td>';
				// print($r[0]);
			}
			// echo '</tr>';
			if ($k == 0) continue;
			else{
				// echo $r[8];
				// echo "<br>";
				$r[8]=strtoupper($r[8]);
				if($r[8]=="CSE")
				{
					$r[8]="Computer Science and Engineering";
					// echo $r[8];
					// echo "<br>";
				}
				if($r[8]=="ISE")
				{
					$r[8]="Information Science and Engineering";
					// echo $r[8];
					// echo "<br>";
				}
				if($r[8]=="ECE")
				{
					$r[8]="Electronics and Communication Engineering";
					// echo $r[8];
					// echo "<br>";
				}
				if($r[8]=="ME")
				{
					$r[8]="Mechanical Engineering";
					// echo $r[8];
					// echo "<br>";
				}
				if($r[8]=="CV")
				{
					$r[8]="Civil Engineering";
					// echo $r[8];
					// echo "<br>";
				}

				
			$q="insert into students (`adm_no`, `usn`, `batch`, `semester`, `section`, `fname`, `mname`, `lname`, `branch`, `kcet`, `comedk`, `jee`, `nationality`, `data_of_admission`, `dob`, `place_of_birth`, `gender`, `mob_no`, `email_id`, `aadhar`, `pan_card`, `sc_st`, `caste`, `annual_income`, `present_state`, `present_dist`, `present_house_no_name`, `present_post_village`, `present_pincode`, `permanent_state`, `permanent_dist`, `permanent_house_no_name`, `permanent_post_village`, `permanent_pin_code`,`lab_batch`) values(\"" . $r[0] . "\",\"" . $r[1] . "\",\"" . $r[2] . "\",\"" . $r[3] . "\",\"" . $r[4] . "\",\"" . $r[5] . "\",\"" . $r[6] . "\",\"" . $r[7] . "\",\"" . $r[8] . "\",\"" . $r[9] . "\",\"" . $r[10] . "\",\"" . $r[11] . "\",\"" . $r[12] . "\",\"" . $r[13] . "\",\"" . $r[14] . "\",\"" . $r[15] . "\",\"" . $r[16] . "\",\"" . $r[17] . "\",\"" . $r[18] . "\",\"" . $r[19] . "\",\"" . $r[20] . "\",\"" . $r[21] . "\",\"" . $r[22] . "\",\"" . $r[23] . "\",\"" . $r[24] . "\",\"" . $r[25] . "\",\"" . $r[26] . "\",\"" . $r[27] . "\",\"" . $r[28] . "\",\"" . $r[29] . "\",\"" . $r[30] . "\",\"" . $r[31] . "\",\"" . $r[32] . "\",\"" . $r[33] . "\", 0);"; 
			$result=$con->query($q); 
			// echo $q;
			//echo "<br>";
			$q1="insert into sslc_details values(\"" . $r[0] . "\",\"" . $r[34] . "\",\"" . $r[35] . "\",\"" . $r[36] . "\",\"" . $r[37] . "\",\"" . $r[38] . "\",\"" . $r[39] . "\",\"" . $r[40] . "\")";
			//echo $q1;
			$con->query($q1);
			$q2="insert into puc_details values(\"" . $r[0] . "\",\"" . $r[41] . "\",\"" . $r[42] . "\",\"" . $r[43] . "\",\"" . $r[44] . "\",\"" . $r[45] . "\",\"" . $r[46] . "\",\"" . $r[47] . "\",\"" . $r[48] . "\",\"" . $r[49] . "\",\"" . $r[50] . "\",\"" . $r[51] . "\",\"" . $r[52] . "\",\"" . $r[53] . "\",\"" . $r[54] . "\",\"" . $r[55] . "\",\"" . $r[56] . "\",\"" . $r[57] . "\",\"" . $r[58] . "\")";
			$con->query($q2);
			$q3="insert into parents_details values(\"" . $r[0] . "\",\"" . $r[1] . "\",\"" . $r[59] . "\",\"" . $r[60] . "\",\"" . $r[61] . "\",\"" . $r[62] . "\",\"" . $r[63] . "\",\"" . $r[64] . "\",\"" . $r[65] . "\",\"" . $r[66] . "\",\"" . $r[67] . "\",\"" . $r[68] . "\",\"" . $r[69] . "\",\"" . $r[70] . "\")";
			$con->query($q3);
		
		}
		}
		// echo '</table>';
	} else {
		echo SimpleXLSX::parseError();
	}
}
echo '
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../../../asset/style/bootstrap.min.css" />
<div class="container">
	<h2>Upload form</h2>
	<form method="post" enctype="multipart/form-data">
		format supported *.XLSX
		<div class="row">
			<div class="col-12">
				<input type="file" name="file" class="btn btn-primary" value="Choose a file" />&nbsp;&nbsp;
				<input type="submit" value="Upload" class="btn btn-success" />
			</div>
		</div>
		select a file and click upload
	</form>
</div>

<div style="position:fixed; bottom:10px; right:10px; z-index:9999;" id="Back-btn">
                <button class="btn btn-info" style="border: 1px solid transparent;border-radius: 50%; padding:8px; margin:0;justify-content: center;display: flex;background-color: #6a6b6d;" onclick="window.history.back();">
                <i class="fas fa-arrow-circle-left" style="width:30px;height:30px;font-size:30px";></i>
                </button>
            </div>

';
