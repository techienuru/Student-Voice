<?php
session_start();
include_once "../includes/connect.php";
if (!isset($_SESSION["student_affairs_id"])) {
    header("location:../login.php");
} else {
    $user_id = $_SESSION["student_affairs_id"];

    $select_user_details = mysqli_query($connect, "SELECT * FROM `student_affairs_unit` WHERE unit_id = $user_id");
    $fetch_user_details = mysqli_fetch_assoc($select_user_details);
    $fullname = $fetch_user_details["fullname"];
    $email = $fetch_user_details["email"];
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
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .card-body {
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

        .btn-primary {
            background-color: #4e73df;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
        }

        .btn-success {
            background-color: #1cc88a;
            color: white;
        }

        .btn-success:hover {
            background-color: #17a673;
        }

        .table thead th {
            background-color: #4e73df;
            color: white;
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .modal-header {
            background-color: #4e73df;
            color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="index.html" class="logo">
                    Affairs Unit
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
                                <span class="user-level">Affairs Unit</span>
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
                    <li class="nav-item">
                        <a href="./dashboard.php">
                            <i class="la la-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="./pending.php">
                            <i class="la la-users"></i>
                            <p>Pending Feedbacks</p>
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="./resolved.php">
                            <i class="la la-cogs"></i>
                            <p>Resolved Feedbacks</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container">
                    <h2 class="mt-4">Resolved Feedbacks</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Course Code</th>
                                    <th>Lecturer</th>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>Level</th>
                                    <th>Subject</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_frm_DB = mysqli_query($connect, "SELECT * FROM `feedback` INNER JOIN `student` ON feedback.student_id = student.student_id INNER JOIN `lecturer` ON feedback.lecturer_id = lecturer.lecturer_id WHERE `feedback`.status = 'Reviewed' ORDER BY feedback.feedback_id DESC LIMIT 5");

                                $number = 1;
                                while ($row = mysqli_fetch_array($select_frm_DB)) {
                                ?>

                                    <tr>
                                        <td><?php echo $row["8"]; ?></td>
                                        <td><?php echo $row["course_code"]; ?></td>
                                        <td><?php echo $row["fullname"]; ?></td>
                                        <td><?php echo $row["faculty"]; ?></td>
                                        <td><?php echo $row["department"]; ?></td>
                                        <td><?php echo $row["level"]; ?></td>
                                        <td><?php echo $row["feedback_type"]; ?></td>
                                        <td>
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#resolvedFeedbackModal<?php echo $row["feedback_id"]; ?>">View</button>
                                        </td>
                                    </tr>

                                    <!-- Resolved Feedback Modal -->
                                    <div class="modal fade" id="resolvedFeedbackModal<?php echo $row["feedback_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="resolvedFeedbackModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h5 class="modal-title" id="resolvedFeedbackModalLabel1">Feedback Details</h5>
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
                                <?php } ?>
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
    <script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../assets/js/ready.js"></script>
    <script src="../assets/js/demo.js"></script>
</body>

</html>