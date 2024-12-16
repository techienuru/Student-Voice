<?php
session_start();
include_once "../includes/connect.php";
if (!isset($_SESSION["admin_id"])) {
    header("location:../login.php");
} else {
    $admin_id = $_SESSION["admin_id"];

    // IF a course is deleted
    if (isset($_POST["delete_student"])) {
        $student_id = $_POST["student_id"];

        $delete_frm_db = mysqli_query($connect, "DELETE FROM `student` WHERE student_id = $student_id");

        if ($delete_frm_db) {
            echo '
            <script>
                window.location.href="./view-students.php";
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

        .table .btn-edit {
            color: #4e73df;
        }

        .table .btn-edit:hover {
            color: #2e59d9;
        }

        .table .btn-delete {
            color: #e74a3b;
        }

        .table .btn-delete:hover {
            color: #c12e2a;
        }

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
                            <p>Manage course </p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container">
                    <h2 class="mt-4">View Registered Students</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Matric No</th>
                                    <th>Department</th>
                                    <th>Faculty</th>
                                    <th>Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_students = mysqli_query($connect, "SELECT * FROM `student`");
                                while ($row = mysqli_fetch_assoc($select_students)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["fullname"] ?></td>
                                        <td><?php echo $row["matricno"] ?></td>
                                        <td><?php echo $row["faculty"] ?></td>
                                        <td><?php echo $row["department"] ?></td>
                                        <td><?php echo $row["level"] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-delete text-white" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo $row["student_id"]; ?>">Delete</button>
                                        </td>
                                    <?php } ?>
                                    </tr>
                                    <!-- End of Example Data -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this student? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="post" action="view-students.php">
                        <input type="hidden" name="student_id" id="studentId">
                        <button type="submit" class="btn btn-confirm" name="delete_student">Confirm</button>
                    </form>
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
        // Handle delete button click to set the student ID in the modal form
        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var studentId = button.data('id');
            var modal = $(this);
            modal.find('#studentId').val(studentId);
        });
    </script>
</body>

</html>