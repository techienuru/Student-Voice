<?php
session_start();
include_once "../includes/connect.php";
if (!isset($_SESSION["student_id"])) {
	header("location:../login.php");
} else {
	$user_id = $_SESSION["student_id"];

	$select_user_details = mysqli_query($connect, "SELECT * FROM `student` WHERE student_id = $user_id");
	$fetch_user_details = mysqli_fetch_assoc($select_user_details);
	$fullname = $fetch_user_details["fullname"];
	$matricno = $fetch_user_details["matricno"];
	$faculty = $fetch_user_details["faculty"];
	$department = $fetch_user_details["department"];
	$level = $fetch_user_details["level"];

	// If a Feedback is submitted
	if (isset($_POST["submit-feedback"])) {
		$lecturer_id = $_POST["lecturer_id"];
		$feedback_type = $_POST["feedback_type"];
		$feedback_message = $_POST["feedback_message"];

		$insert_into_db = mysqli_query($connect, "INSERT INTO `feedback` (student_id,lecturer_id,feedback_type,message) VALUES($user_id,$lecturer_id,'$feedback_type','$feedback_message')");

		if ($insert_into_db) {
			echo '
            <script>
				alert("success!");
                window.location.href="./view-feedback.php";
            </script>
        ';
			die();
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Feedback App - Submit Feedback</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../assets/css/ready.css">
	<link rel="stylesheet" href="../assets/css/demo.css">
	<style>
		/* Styling for Cards */
		.card-feedback {
			border-radius: 10px;
			transition: transform 0.3s;
		}

		.card-feedback:hover {
			transform: translateY(-10px);
			box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
		}

		.card-feedback .card-header {
			font-size: 20px;
			font-weight: bold;
			background-color: #4e73df;
			color: white;
		}

		.card-feedback .card-body {
			font-size: 16px;
		}

		/* Progress Bar Animation */
		.progress-bar-animated {
			width: 0;
			animation: progressBar 2s forwards;
		}

		@keyframes progressBar {
			from {
				width: 0;
			}

			to {
				width: 100%;
			}
		}

		/* Feedback Form Styling */
		.feedback-form {
			margin-top: 20px;
		}

		.feedback-form .form-group {
			margin-bottom: 20px;
		}

		.feedback-form .btn-submit {
			background-color: #1cc88a;
			color: white;
			font-size: 18px;
			padding: 10px 20px;
			border-radius: 50px;
			transition: background-color 0.3s;
		}

		.feedback-form .btn-submit:hover {
			background-color: #17a673;
		}

		/* Modal Styling */
		.modal-header {
			background-color: #4e73df;
			color: white;
		}

		.modal-footer .btn-confirm {
			background-color: #1cc88a;
			color: white;
		}

		.modal-footer .btn-confirm:hover {
			background-color: #17a673;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="index.html" class="logo">
					Feedback App
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
		</div>
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">
				<div class="user">
					<div class="photo">
						<img src="../assets/img/profile.png">
					</div>
					<div class="info">
						<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								<?php echo $fullname; ?>
								<span class="user-level">Student</span>
								<span class="caret"></span>
							</span>
						</a>
						<div class="clearfix"></div>

						<div class="collapse in" id="collapseExample" aria-expanded="true">
							<ul class="nav">
								<li>
									<a href="./logout.php">
										<span class="link-collapse">Logout</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<ul class="nav">
					<li class="nav-item active">
						<a href="./dashboard.php">
							<i class="la la-dashboard"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="./submit-feedback.php">
							<i class="la la-calendar-check-o"></i>
							<p>Submit Feedback</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="./view-feedback.php">
							<i class="la la-check-square"></i>
							<p>View Feedback</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="./profile.php">
							<i class="la la-times-circle"></i>
							<p>Profile</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="container">
					<h2 class="mt-4">Submit Your Feedback</h2>
					<div class="row mt-5">
						<div class="col-md-4">
							<div class="card card-feedback">
								<div class="card-header text-center">
									Course Content
								</div>
								<div class="card-body">
									<p>Please provide feedback on the course materials and content.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-feedback">
								<div class="card-header text-center">
									Lecturer Performance
								</div>
								<div class="card-body">
									<p>Give your opinion on the performance of the lecturer.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-feedback">
								<div class="card-header text-center">
									Overall Experience
								</div>
								<div class="card-body">
									<p>Share your overall experience of the course.</p>
								</div>
							</div>
						</div>
					</div>

					<div class="feedback-form mt-5">
						<form action="submit-feedback.php" method="POST">
							<div class="form-group">
								<label for="course-select">Select Course</label>
								<select class="form-control" id="course-select" name="course_code">
									<option value="">Select a course</option>
									<?php
									$select_frm_DB = mysqli_query($connect, "SELECT * FROM `course` WHERE faculty = '$faculty' AND department = '$department' AND level = '$level'");

									while ($row = mysqli_fetch_assoc($select_frm_DB)) {
									?>
										<option value="<?php echo $row["course_code"]; ?>"><?php echo $row["course_code"]; ?></option>
									<?php } ?>
								</select>
							</div>

							<!-- Hidden Input for Lecturer ID -->
							<input type="hidden" id="lecturer-id" name="lecturer_id" class="form-control" value="">

							<div class="form-group">
								<label for="lecturer-name">Lecturer Name</label>
								<input type="text" id="lecturer-name" name="lecturer_name" class="form-control" value="" readonly>
							</div>


							<div class="form-group">
								<label for="feedback-type">Feedback Type</label>
								<select class="form-control" id="feedback-type" name="feedback_type">
									<option value="Course Content">Course Content</option>
									<option value="Lecturer Performance">Lecturer Performance</option>
									<option value="Overall Experience">Overall Experience</option>
								</select>
							</div>

							<div class="form-group">
								<label for="feedback-message">Message</label>
								<textarea id="feedback-message" name="feedback_message" class="form-control" rows="4"></textarea>
							</div>

							<button type="submit" name="submit-feedback" class="btn btn-submit btn-block">Submit Feedback</button>
						</form>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Privacy
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Terms
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2023, made with <i class="la la-heart heart text-danger"></i> by Coding House
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="../assets/js/core/popper.min.js"></script>
	<script src="../assets/js/core/bootstrap.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#course-select').on('change', function() {
				var selectedCourse = $(this).val();
				if (selectedCourse) {
					$.ajax({
						type: 'POST',
						url: 'get_lecturer.php',
						data: {
							course_code: selectedCourse
						},
						dataType: 'json',
						success: function(data) {
							$('#lecturer-name').val(data.fullname);
							$('#lecturer-id').val(data.lecturer_id); // Setting the hidden lecturer ID
						}
					});
				} else {
					$('#lecturer-name').val('');
					$('#lecturer-id').val('');
				}
			});
		});
	</script>
</body>

</html>