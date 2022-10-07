<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require_once __DIR__.'/../src/SimpleXLSX.php';
require_once "config1.php";




if (isset($_FILES['file'])) {
	
	if ( $xlsx = SimpleXLSX::parse( $_FILES['file']['tmp_name'] ) ) {

		echo '<h2>Successfully Uploaded</h2>';
		echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

		$dim = $xlsx->dimension();
		$cols = $dim[0];

		foreach ( $xlsx->rows() as $k => $r ) {
					 // skip first row
			// print($k)
			echo '<tr>';
			for ( $i = 0; $i < $cols; $i ++ ) {
				//echo '<td>' . ( isset( $r[ $i ] ) ? $r[ $i ] : '&nbsp;' ) . '</td>';
				// print($r[0]);
			}
			echo '</tr>';
			if ($k == 0) continue;
			else{

				// echo $r[3];
				// echo "<br>";
				$r[3]=strtoupper($r[3]);
				if($r[3]=="CSE")
				{
					$r[3]="Computer Science and Engineering";
					// echo $r[3];
					// echo "<br>";
				}
				if($r[3]=="ISE")
				{
					$r[3]="Information Science and Engineering";
					// echo $r[3];
					// echo "<br>";
				}
				if($r[3]=="ECE")
				{
					$r[3]="Electronics and Communication Engineering";
					// echo $r[3];
					// echo "<br>";
				}
				if($r[3]=="ME")
				{
					$r[3]="Mechanical Engineering";
					// echo $r[3];
					// echo "<br>";
				}
				if($r[3]=="CV")
				{
					$r[3]="Civil Engineering";
					// echo $r[8];
					// echo "<br>";
				}

			$q="insert into faculty_details values(\"" . $r[0] . "\",\"" . $r[1] . "\",\"" . $r[2] . "\",\"" . $r[3] . "\",\"" . $r[4] . "\",\"" . $r[5] . "\",\"" . $r[6] . "\",\"" . $r[7] . "\",\"" . $r[8] . "\",\"" . $r[9] . "\",\"" . $r[10] . "\",\"" . $r[11] . "\",\"" . $r[12] . "\",\"" . $r[13] . "\",\"" . $r[14] . "\",\"" . $r[15] . "\",\"" . $r[16] . "\",\"" . $r[17] . "\",\"" . $r[18] . "\",\"" . $r[19] . "\",\"" . $r[20] . "\",\"" . $r[21] . "\",\"" . $r[22] . "\",\"" . $r[23] . "\",\"" . $r[24] . "\",\"" . $r[25] . "\",\"" . $r[26] . "\",\"" . $r[27] . "\",\"" . $r[28] . "\");"; 
			$result=$con->query($q);
			//echo $q;
			
		
		}
		}
		echo '</table>';
	} else {
		echo  '		
		<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="z-index: 1;">
		  <div class="toast-header">
			<img src="..." class="rounded mr-2" alt="...">
			<strong class="mr-auto">Bootstrap</strong>
			<small>11 mins ago</small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="toast-body">
				<h5> Parsing Error </h5>
			Data not uploaded please check format of file.
		  </div>
		</div>';
		
	}
}
echo '
<link rel="stylesheet" href="../../../asset/style/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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