<?php

require_once "../config.php";
$con = $link;
										error_reporting(0);

	$q1 = "select distinct faculty_dept from faculty_details";


	$result1 = $con->query($q1);

?>



	<?php
	session_start();
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: login.php");
		exit;
	}


	?>

	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="../style_admin.css">
		<title>Document</title>
	</head>

	<body>

		<div class="wrapper">
			<!-- Sidebar  -->
			<nav id="sidebar">
			<div class="sidebar-header">
					<div  style="margin-left: 50px;">
						<img src="../asset/img/1aiet-logo.png" style="height: 10vh; " class="img-fluid ml-auto" alt="" srcset="">
					</div>
				</div>

				<ul class="list-unstyled components">

					<li class="active">
						<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Subject</a>
						<ul class="collapse list-unstyled" id="homeSubmenu">
							<li>
								<a href="add_sub.php">Add Subject</a>
							</li>
							<li>
								<a href="view_sub.php">View Subject</a>
							</li>

						</ul>
					</li>
					<li>
						<a href="faculty_subject_mapping.php">Faculty-Subject Mapping</a>
					</li>
					<li>
						<a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Faculty</a>
						<ul class="collapse list-unstyled" id="pageSubmenu1">
							<li>
								<a href="faculty_insert.php">Add Faculty</a>
							</li>
							<li>
								<a href="faculty_view_details.php">View Faculty</a>
							</li>
							<li>
								<a href="register.php">Faculty Register</a>
							</li>

						</ul>
					</li>
					<li>
						<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Student</a>
						<ul class="collapse list-unstyled" id="pageSubmenu">
							<li>
								<a href="students_insert.php">Add Student</a>
							</li>
							<li>
								<a href="student_view_details.php">View Student</a>
							</li>


						</ul>
					</li>
					<li>
						<a href="#downloadSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Download</a>
						<ul class="collapse list-unstyled" id="downloadSubmenu">
							<li>
								<a href="./student_excel.php">Student Details</a>
							</li>
							<li>
								<a href="#">Faculty Details</a>
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

						<button type="button" id="sidebarCollapse" style="width: 3.5%;" class="btn btn-info ">
							<i class="fas fa-align-left"></i>

						</button>
						<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fas fa-align-justify"></i>
						</button>

						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="nav navbar-nav ml-auto">
								<li class="nav-item active">
									<a class="nav-link m-1 glow" href="#" onclick="alert('notificaions')"><i class="fas fa-bell glow "></i></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="logout.php"><i class="fas fa-power-off p-1"> Logout</i></a>
								</li>

							</ul>
						</div>
					</div>
				</nav>
				<!-- page content start -->
				<div>
					<div class="container">
						<form method="post" action="faculty_excel_extract_data.php" align="center">
							<div class="row">
								<div class=" form-group col-md-3">
									<select class="form-control" name="faculty_dept" id="faculty_dept" aria-label="Default select example">
										<option value="selected">Department</option>
										<?php foreach ($result1 as $r) { ?>
											<option class="form-control" value="<?php echo $r["faculty_dept"] ?>"><?php echo $r["faculty_dept"] ?></option>

										<?php } ?>
										<option class="form-control" value="all">ALL Department</option>



									</select>
								</div>

								<div class="col-md-3">
									<input type="submit" name="export" value="Download" class="btn btn-success" />

								</div>

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



	