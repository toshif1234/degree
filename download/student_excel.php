<?php
require_once "../config.php";
$con = $link;

	$q1 = "select distinct batch from students";
	$q2 = "select distinct branch from students";
	$q3 = "select distinct semester from students";
	$q4 = "select distinct section from students";

	$result1 = $con->query($q1);
	$result2 = $con->query($q2);
	$result3 = $con->query($q3);
	$result4 = $con->query($q4);
?>



	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="../asset/style/bootstrap.min.css">
		<link rel="stylesheet" href="../asset/style/style_fac.css">
		<link rel="shortcut icon" href="../asset/img/1aiet-logo.png" />
		<title>Faculty | Student Excel</title>
	</head>

	<body>
		<style>
			body,
			html,
			.wraper {
				background-image: url("../asset/img/bg.png") !important;
				height: 100vh !important;
				width: 100vw !important;
				background-position: center !important;
				background-repeat: no-repeat !important;
				background-size: cover !important;
				height: 100% !important;
				align-content: center !important;
			}
		</style>
		<div class="wrapper">
			<!-- Sidebar  -->
			<nav id="sidebar">
				<div class="sidebar-header">
					<div style="margin-left: 50px;">
						<a href="../fac_dashboard.php">
							<img src="../asset/img/1aiet-logo.png" style="height: 10vh; " class="img-fluid ml-auto" alt="" srcset="">
						</a>
					</div>
				</div>

				<ul class="list-unstyled components">
					<li>
						<a href="#">IA Management</a>
					</li>
					<li>
						<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Lession Plan</a>
						<ul class="collapse list-unstyled" id="pageSubmenu">
							<li>
								<a href="../lesson_plan/lesson_plan.php">Planning and Tracking</a>
							</li>
							<li>
								<a href="#">CO and PO Mapping</a>
							</li>

						</ul>
					</li>
					<li>
						<a href="#attendanceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Attendance</a>
						<ul class="collapse list-unstyled" id="attendanceSubmenu">
							<li>
								<a href="../attendance/Add_Attendence.html">Add Attendance</a>
							</li>
							<li>
								<a href="../attendance/Edit_Attendence.html">View Attendance</a>
							</li>

						</ul>
					</li>
					<li class="active">
						<a href="#downloadSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Download</a>
						<ul class="collapse list-unstyled" id="downloadSubmenu">
							<li>
								<a href="#" style="background:white; color:#7386D5;">Student</a>
							</li>
							<li>
								<a href="#">IA Marks</a>
							</li>

						</ul>
					</li>
					<li>
						<a href="#">Contact</a>
					</li>
				</ul>


			</nav>

			<!-- Page Content  -->
			<div id="content">

			<nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info ">
                        <i class="fas fa-align-left"></i>

                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: flex-end;">

                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" onclick="alert('notificaions')"><i class="fas fa-bell m-1"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../logout.php"><i class="fas fa-power-off m-1"> Logout</i></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

				<!-- page content start -->
				<div>
					<div class="container">
						<form method="post" action="students_excel_extract_data.php" align="center">
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


				</div>
				<!-- page content end -->
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
		<script>
			$(document).ready(function() {
				$('#sidebarCollapse').on('click', function() {
					$('#sidebar').toggleClass('active');
				});
			});
		</script>
	</body>

	</html>