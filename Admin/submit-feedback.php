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
					<form>
                    <div class="form-group">
							<label for="feedback-type">Select Course</label>
							<select class="form-control" id="feedback-type">
								<option>Cmp 411</option>
								<option>cmp421</option>
								<option>cmp432(Introduction to A.I)</option>
							</select>
						</div>

                        <div class="form-group">
							<label for="feedback-type">Select Lecturer</label>
                            <input type="text" name="" class="form-control" value="Mr Nuru" readonly>
						</div>

						<div class="form-group">
							<label for="feedback-type">Feedback Type</label>
							<select class="form-control" id="feedback-type">
								<option>Course Content</option>
								<option>Lecturer Performance</option>
								<option>Overall Experience</option>
							</select>
						</div>
						<div class="form-group">
							<label for="feedback-text">Your Feedback</label>
							<textarea class="form-control" id="feedback-text" rows="5" placeholder="Write your feedback here..."></textarea>
						</div>
						<button type="button" class="btn btn-submit" data-toggle="modal" data-target="#submitModal">Submit Feedback</button>
					</form>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="submitModalLabel">Confirm Submission</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Are you sure you want to submit your feedback?
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-confirm">Submit</button>
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
