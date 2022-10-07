<?php

require_once '../config.php';
$con = $link;
		error_reporting(0);

$con = $link;

	$q1 = "select distinct batch from students";
	$q2 = "select distinct branch from students";
	$q3 = "select distinct semester from students";
	$q4 = "select distinct section from students";

	$result1 = $con->query($q1);
	$result2 = $con->query($q2);
	$result3 = $con->query($q3);
	$result4 = $con->query($q4);
	
	include("../template/fac-auth.php");
	include("../template/sidebar-fac.php");
	
?>
	

					<div class="container">
						<form method="post" action="students_excel_extract_data.php"  align="center">
						<div class="row">
								<div class="col-md-1"></div>
								<div class=" form-group col-md-2">
									<select class="form-control" name="batch" id="batch" aria-label="Default select example">
										<option value="selected">Batch</option>
										<?php foreach ($result1 as $r) { ?>
											<option class="form-control" value="<?php echo $r["batch"] ?>"><?php echo $r["batch"] ?></option>
											<!-- <option class="form-control" value="2019">2019</option> -->
										<?php } ?>


									</select>
								</div>
								<div class=" form-group col-md-2">
									<select class="form-control" name="branch" id="branch" aria-label="Default select example">
										<option value="selected">Branch</option>
										<?php foreach ($result2 as $r2) { ?>
											<option class="form-control" value="<?php echo $r2["branch"] ?>"><?php echo $r2["branch"] ?></option>
											<!-- <option class="form-control" value="2019">2019</option> -->
										<?php } ?>

									</select>
								</div>
								<div class=" form-group col-md-2">
									<select class="form-control" name="sem" id="sem" aria-label="Default select example">
										<option value="selected">Semester</option>
										<?php foreach ($result3 as $r3) { ?>
											<option class="form-control" value="<?php echo $r3["semester"] ?>"><?php echo $r3["semester"] ?></option>
											<!-- <option class="form-control" value="2019">2019</option> -->
										<?php } ?>
									</select>
								</div>
								<div class=" form-group col-md-2">
									<select class="form-control" name="sec" id="sec" aria-label="Default select example">
										<option value="selected">Section</option>
										<?php foreach ($result4 as $r4) { ?>
											<option class="form-control" value="<?php echo $r4["section"] ?>"><?php echo $r4["section"] ?></option>
											<!-- <option class="form-control" value="2019">2019</option> -->
										<?php } ?> <option class="form-control" value="all">ALL</option>

									</select>
								</div>

								<div class="col-md-2">
									<input type="submit" name="export" value="Download" class="btn btn-success" />

								</div>
								<div class="col-md-1"></div>
							</div>
						</form>
					</div>

				

				<!-- page content end -->



		<?php  ?>

		<?php include("../template/footer-fac.php") ?>

		<script>
			$(document).ready(function() {
				$('#sidebarCollapse').on('click', function() {
					$('#sidebar').toggleClass('active');
				});
			});
		</script>
	</body>

	</html>