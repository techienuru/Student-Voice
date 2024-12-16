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
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Feedback app</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../assets/css/ready.css">
	<link rel="stylesheet" href="../assets/css/demo.css">
	<style>
		/* Styling for Cards */
		.card-stats {
			border-radius: 8px;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		}

		.card-stats .statistics .info {
			text-align: left;
			padding-left: 15px;
		}

		.card-stats .statistics .icon {
			text-align: right;
			font-size: 48px;
			color: rgba(255, 255, 255, 0.6);
		}

		.card-primary {
			background-color: #4e73df;
			color: white;
		}

		.card-warning {
			background-color: #f6c23e;
			color: white;
		}

		.card-success {
			background-color: #1cc88a;
			color: white;
		}

		/* Styling for the Table */
		.table-responsive {
			margin-top: 20px;
		}

		.table th {
			background-color: #4e73df;
			color: white;
			border: none;
		}

		.table td {
			border-top: 1px solid #e3e6f0;
		}

		.table .text-success {
			color: #1cc88a;
		}

		.table .text-warning {
			color: #f6c23e;
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
				<div class="container-fluid">
					<!-- Header -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<h2 class="card-title">Welcome, [<?php echo $fullname; ?>]</h2>
									<p class="card-text">Your personalized dashboard for submitting and viewing feedback.</p>
								</div>
							</div>
						</div>
					</div>

					<!-- Summary Cards -->
					<div class="row mt-4">
						<div class="col-md-4">
							<div class="card card-stats card-primary">
								<div class="card-body">
									<div class="statistics">
										<div class="info">
											<h3 class="card-title">Courses</h3>
											<?php
											$select_number_of_courses = mysqli_query($connect, "SELECT COUNT(course_id) AS noOfCourse FROM `course` WHERE faculty = '$faculty' AND department = '$department' AND level = '$level'");
											$fetch_number_of_courses = mysqli_fetch_assoc($select_number_of_courses);

											$select_number_of_feedbacks = mysqli_query($connect, "SELECT COUNT(feedback_id) AS noOfFeedbacks FROM `feedback` WHERE student_id = '$user_id'");
											$fetch_number_of_feedbacks = mysqli_fetch_assoc($select_number_of_feedbacks);

											$select_no_of_pending_feedbacks = mysqli_query($connect, "SELECT COUNT(feedback_id) AS noOfPendingFeedback FROM `feedback` WHERE student_id = '$user_id' AND status = 'Pending'");
											$fetch_number_of_pending_feedbacks = mysqli_fetch_assoc($select_no_of_pending_feedbacks);
											?>
											<h4 class="stat-text">
												<?php echo $fetch_number_of_courses["noOfCourse"]; ?>
											</h4>
										</div>
										<div class="icon">
											<i class="la la-book"></i>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<hr />
									<div class="stats">
										<i class="la la-refresh"></i> Updated just now
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-stats card-warning">
								<div class="card-body">
									<div class="statistics">
										<div class="info">
											<h3 class="card-title">Feedbacks Submitted</h3>
											<h4 class="stat-text">
												<?php echo $fetch_number_of_feedbacks["noOfFeedbacks"]; ?>
											</h4>
										</div>
										<div class="icon">
											<i class="la la-comments"></i>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<hr />
									<div class="stats">
										<i class="la la-check"></i> You have pending feedback
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card card-stats card-success">
								<div class="card-body">
									<div class="statistics">
										<div class="info">
											<h3 class="card-title">Pending Feedbacks</h3>
											<h4 class="stat-text">
												<?php echo $fetch_number_of_pending_feedbacks["noOfPendingFeedback"]; ?>
											</h4>
										</div>
										<div class="icon">
											<i class="la la-hourglass-half"></i>
										</div>
									</div>
								</div>
								<div class="card-footer">
									<hr />
									<div class="stats">
										<i class="la la-info-circle"></i> Complete your feedback
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- Recent Activity -->
					<div class="row mt-4">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Recent Activity</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="table">
											<thead class="text-primary">
												<tr>
													<th>Course</th>
													<th>Lecturer</th>
													<th>Date Submitted</th>
													<th>Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$select_frm_DB = mysqli_query($connect, "SELECT * FROM `feedback` INNER JOIN `student` ON feedback.student_id = student.student_id INNER JOIN `lecturer` ON feedback.lecturer_id = lecturer.lecturer_id WHERE feedback.student_id = $user_id ORDER BY feedback.feedback_id DESC LIMIT 5");

												$number = 1;
												while ($row = mysqli_fetch_array($select_frm_DB)) {
												?>
													<tr>
														<td>
															<?php echo $row["course_code"]; ?>
															(<?php echo $row["course_title"]; ?>)
														</td>
														<td>
															<?php echo $row["fullname"]; ?>
														</td>
														<td>
															<?php echo $row["date_sent"]; ?>
														</td>
														<td class="text-success">
															<?php echo $row["status"]; ?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
	</div>
</body>
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugin/chartist/chartist.min.js"></script>
<script src="../assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/ready.min.js"></script>
<script src="../assets/js/demo.js"></script>

</html>