<?php
session_start();
include_once "../includes/connect.php";
if (!isset($_SESSION["admin_id"])) {
    header("location:../login.php");
} else {
    $admin_id = $_SESSION["admin_id"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin Dashboard - Feedback App</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/css/ready.css">
    <link rel="stylesheet" href="../assets/css/demo.css">
    <style>
        /* Dashboard Widgets */
        .card-stats {
            border-radius: 10px;
            transition: transform 0.3s;
        }

        .card-stats:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .card-stats .card-header {
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .card-stats .card-body {
            font-size: 16px;
        }

        .card-primary {
            background-color: #4e73df;
        }

        .card-warning {
            background-color: #f6c23e;
        }

        .card-success {
            background-color: #1cc88a;
        }

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
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="index.html" class="logo">
                    Feedback App - Admin
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
                                Admin
                                <span class="user-level">Administrator</span>
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
                        <a href="./manage-staff.php">
                            <i class="la la-comments"></i>
                            <p>Manage Student Affairs Unit(Staff)</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./view-students.php">
                            <i class="la la-users"></i>
                            <p>View Students</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./register-lecturers.php">
                            <i class="la la-cogs"></i>
                            <p>Create Lecturer</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="./manage-course.php">
                            <i class="la la-cogs"></i>
                            <p>Manage course</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container">
                    <h2 class="mt-4">Admin Dashboard</h2>
                    <div class="row">
                        <?php
                        $select_total_feedbacks = mysqli_query($connect, "SELECT COUNT(feedback_id) AS totalFeedback FROM `feedback`");
                        $fetch_total_feedbacks = mysqli_fetch_assoc($select_total_feedbacks);

                        $select_pending_feedbacks = mysqli_query($connect, "SELECT COUNT(feedback_id) AS pendingFeedback FROM `feedback` WHERE status = 'Pending'");
                        $fetch_pending_feedbacks = mysqli_fetch_assoc($select_pending_feedbacks);

                        $select_reviewed_feedbacks = mysqli_query($connect, "SELECT COUNT(feedback_id) AS reviewedFeedback FROM `feedback` WHERE status = 'Reviewed'");
                        $fetch_reviewed_feedbacks = mysqli_fetch_assoc($select_reviewed_feedbacks);
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-stats card-primary">
                                <div class="card-header">
                                    Total Feedbacks
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <?php echo $fetch_total_feedbacks["totalFeedback"]; ?>
                                    </h3>
                                    <p class="card-category">Feedbacks received this month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-stats card-warning">
                                <div class="card-header">
                                    Pending Feedbacks
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <?php echo $fetch_pending_feedbacks["pendingFeedback"]; ?>
                                    </h3>
                                    <p class="card-category">New feedbacks awaiting review</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="card card-stats card-success">
                                <div class="card-header">
                                    Resolved Feedbacks
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <?php echo $fetch_reviewed_feedbacks["reviewedFeedback"]; ?>
                                    </h3>
                                    <p class="card-category">Feedbacks resolved this month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <h4>Recent Feedbacks</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th>Date Submitted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_frm_DB = mysqli_query($connect, "SELECT * FROM `feedback` INNER JOIN `student` ON feedback.student_id = student.student_id INNER JOIN `lecturer` ON feedback.lecturer_id = lecturer.lecturer_id ORDER BY feedback.feedback_id DESC LIMIT 5");

                                $number = 1;
                                while ($row = mysqli_fetch_array($select_frm_DB)) {
                                ?>
                                    <tr>
                                        <td><?php echo $number; ?></td>
                                        <td><?php echo $row["8"]; ?></td>
                                        <td><?php echo $row["course_code"]; ?></td>
                                        <td><?php echo $row["course_title"]; ?></td>
                                        <td><?php echo $row["date_sent"]; ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#feedbackModal<?php echo $row["feedback_id"]; ?>">View</button>
                                        </td>
                                    </tr>

                                    <!-- Feedback Modal -->
                                    <div class="modal fade" id="feedbackModal<?php echo $row["feedback_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title" id="feedbackModalLabel">Feedback Details</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5>
                                                        Feedback Type: <?php echo $row["feedback_type"]; ?>
                                                    </h5>
                                                    <h5>Message:</h5>
                                                    <p>
                                                        <?php echo $row["message"]; ?>
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php $number++;
                                } ?>
                            </tbody>
                        </table>
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
    <script src="../assets/js/plugin/jquery-mapael/maps