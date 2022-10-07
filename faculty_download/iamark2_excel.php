<?php

require_once '../config.php';
$con = $link;

$q1 = "select distinct sub from ia_marks2";
//$q2 = "select distinct branch from ia_marks2";
$q3 = "select distinct sem from ia_marks2";
$q4 = "select distinct sec from ia_marks2";
$q5 = "select distinct branch from ia_marks1";
$result5 = $con->query($q5);

$result1 = $con->query($q1);
//$result2 = $con->query($q2);
$result3 = $con->query($q3);
$result4 = $con->query($q4);

include("../template/fac-auth.php");
error_reporting(0);
include("../template/sidebar-fac.php");
?>



<!-- page content start -->
<div>
	<div class="container">
		<form method="post" action="iamark2_excel_extract_data.php" align="center">
			<div class="row">
				<div class="col-md-1"></div>
				<div class=" form-group col-md-2">
					<select class="form-control" name="branch" id="branch" aria-label="Default select example">
						<option value="selected">Branch</option>
						<?php foreach ($result5 as $r5) { ?>
							<option class="form-control" value="<?php echo $r5["branch"] ?>"><?php echo $r5["branch"] ?></option>
							<!-- <option class="form-control" value="2019">2019</option> -->
						<?php } ?>
					</select>
				</div>


				<div class=" form-group col-md-2">
					<select class="form-control" name="sem" id="sem" aria-label="Default select example">
						<option value="selected">Semester</option>
						<?php foreach ($result3 as $r3) { ?>
							<option class="form-control" value="<?php echo $r3["sem"] ?>"><?php echo $r3["sem"] ?></option>
							<!-- <option class="form-control" value="2019">2019</option> -->
						<?php } ?>
					</select>
				</div>
				<div class=" form-group col-md-2">
					<select class="form-control" name="sec" id="sec" aria-label="Default select example">
						<option value="selected">Section</option>
						<?php foreach ($result4 as $r4) { ?>
							<option class="form-control" value="<?php echo $r4["sec"] ?>"><?php echo $r4["sec"] ?></option>
							<!-- <option class="form-control" value="2019">2019</option> -->
						<?php } ?> <option class="form-control" value="all">ALL</option>

					</select>
				</div>
				<div class=" form-group col-md-2">
					<select class="form-control" name="sub" id="sub" aria-label="Default select example">
						<option value="selected">Subject</option>
						<?php

                    $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];
					$faculty_name = $_SESSION['username'];

                    if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                        $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name and a.branch = '" . $fac_branch . "'";
                    } else {
                        $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                    }
                    // echo $fac_branch;
                    $resultst = $con->query($qt);
                    $subjects_arr = array();
                    if ($fac_branch == 'MATHEMATICS') {
                        echo "1";
                        foreach ($resultst as $r2) {
                            if(in_array($r2["sub_code"] . " - " . $r2["sub_name"], $subjects_arr)){
                                continue;
                            }
                            $subjects_arr[] = $r2["sub_code"] . " - " . $r2["sub_name"];
                        }
                    } else {
                        if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                            foreach ($resultst as $r) {
                                if ($r['lab'] != '1') {
                                    $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                } else {
                                    if ($r['branch'] == $fac_branch) {
                                        $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                    }
                                }
                            }
                        } else {
                            foreach ($resultst as $r) {
                                if ($r['sub_id'] != '3') {
                                    if ($r['sub_id'] == '1') {
                                        $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                    } else {
                                        if ($r['branch'] == $fac_branch) {
                                            $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                        }
                                    }
                                }
                            }
                        }
                    }
                    // print_r($subjects_arr);
                    foreach ($subjects_arr as $r) {
                    ?>
                        <option class="form-control" value="<?php echo $r ?>"><?php echo $r ?></option>
                    <?php  } ?>


					</select>
				</div>

				<div class="col-md-2">
					<input type="submit" name="export" value="Download" class="btn btn-success" />

				</div>
				<div class="col-md-1"></div>
			</div>
		</form>
	</div>


</div>
<!-- page content end -->
</div>
</div>

<?php include("../template/footer-fac.php") ?>

<script>
	$(document).ready(function() {
		$('#sidebarCollapse').on('click', function() {
			$('#sidebar').toggleClass('active');
		});
	});
</script>
<?php  ?>
</body>

</html>