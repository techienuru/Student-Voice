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

	// IF a new password is set
	if (isset($_POST["save_changes"])) {
		$new_password = $_POST["new_password"];

		$update_db = mysqli_query($connect, "UPDATE `student` SET password = '$new_password' WHERE student_id = $user_id");

		if ($update_db) {
			echo '
            <script>
				alert("success!");
                window.location.href="./profile.php";
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
	<title>Feedback App - Profile</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../assets/css/ready.css">
	<link rel="stylesheet" href="../assets/css/demo.css">
	<style>
		/* Styling for Profile Card */
		.card-profile {
			border-radius: 10px;
			box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
			margin-top: 30px;
		}

		.card-profile .card-header {
			font-size: 20px;
			font-weight: bold;
			background-color: #4e73df;
			color: white;
			text-align: center;
		}

		.card-profile .card-body {
			font-size: 16px;
			padding: 20px;
		}

		.card-profile .form-group label {
			font-weight: bold;
		}

		.card-profile .form-control[readonly] {
			background-color: #e9ecef;
			opacity: 1;
		}

		.card-profile .btn-update {
			background-color: #1cc88a;
			color: white;
			font-size: 18px;
			padding: 10px 20px;
			border-radius: 50px;
			transition: background-color 0.3s;
		}

		.card-profile .btn-update:hover {
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
					<h2 class="mt-4">Your Profile</h2>
					<div class="card card-profile">
						<div class="card-header">
							Profile Details
						</div>
						<div class="card-body">
							<form>
								<div class="form-group">
									<label for="fullName">Full Name</label>
									<input type="text" class="form-control" id="fullName" value="<?php echo $fullname; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="matricNo">Matric Number</label>
									<input type="text" class="form-control" id="matricNo" value="<?php echo $matricno; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="faculty">Faculty</label>
									<input type="text" class="form-control" id="faculty" value="<?php echo $faculty; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="department">Department</label>
									<input type="text" class="form-control" id="department" value="<?php echo $department; ?>" readonly>
								</div>
								<button type="button" class="btn btn-update" data-toggle="modal" data-target="#updatePasswordModal">Update Password</button>
							</form>
						</div>
					</div>

					<!-- Modal for Updating Password -->
					<div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="updatePasswordModalLabel">Update Password</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form action="profile.php" method="POST">
										<div class="form-group">
											<label for="newPassword">New Password</label>
											<input type="password" class="form-control js-new-password" name="new_password" required>
											<small class="text-danger js-error"></small>
										</div>
										<div class="form-group">
											<label for="confirmPassword">Confirm Password</label>
											<input type="password" class="form-control js-confirm-password" name="confirm_password" required>
											<small class="text-danger js-error"></small>
										</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" name="save_changes" class="btn btn-update js-save-changes">Save changes</button>
								</div>
								</form>
							</div>
						</div>
					</div>
					<!-- End of Modal -->
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

	<script>
		const saveChangesBtn = document.querySelector('.js-save-changes');
		const newPasswordElement = document.querySelector('.js-new-password');
		const confirmPasswordElement = document.querySelector('.js-confirm-password');
		const errorElement = document.querySelectorAll('.js-error');

		saveChangesBtn.addEventListener("click", (e) => {
			let isValid = true;
			if (newPasswordElement.value !== confirmPasswordElement.value) {
				isValid = false;
				errorElement.forEach((errorElement) => {
					errorElement.innerHTML = "Password Mismatch!";
				});
			}

			if (isValid != true) {
				e.preventDefault();
			}
		});
	</script>

</body>

</html>