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

		/* Feedback Table Styling */
		.table-feedbacks {
			margin-top: 20px;
		}

		.table-feedbacks th,
		.table-feedbacks td {
			vertical-align: middle;
			text-align: center;
		}

		.table-feedbacks .btn-view,
		.table-feedbacks .btn-delete {
			border-radius: 50px;
			font-size: 14px;
			padding: 5px 15px;
		}

		.table-feedbacks .btn-view {
			background-color: #4e73df;
			color: white;
			margin-right: 5px;
		}

		.table-feedbacks .btn-view:hover {
			background-color: #3752a3;
		}

		.table-feedbacks .btn-delete {
			background-color: #e74a3b;
			color: white;
		}

		.table-feedbacks .btn-delete:hover {
			background-color: #c43729;
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
								Hizrian
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
					<h2 class="mt-4">View Your Feedback(s)</h2>

					<!-- Feedback Table -->
					<table class="table table-hover table-feedbacks">
						<thead>
							<tr>
								<th>#</th>
								<th>Course</th>
								<th>Title</th>
                                <th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Introduction to Programming</td>
								<td>Course Content Feedback</td>
                                <td class="text-success">Reviewed</td>
								<td>
									<button class="btn btn-view" data-toggle="modal" data-target="#viewModal1">View</button>
									<button class="btn btn-delete">Delete</button>
								</td>
							</tr>
						</tbody>
					</table>

					<!-- Modal for Viewing Feedback 1 -->
					<div class="modal fade" id="viewModal1" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel1" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="viewModalLabel1">Feedback Details</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>This is the feedback message for "Course Content Feedback" on "Introduction to Programming".</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Modal for Viewing Feedback 2 -->
					<div class="modal fade" id="viewModal2" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel2" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="viewModalLabel2">Feedback Details</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<p>This is the feedback message for "Lecturer Performance Feedback" on "Data Structures".</p>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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

</body>

</html>
