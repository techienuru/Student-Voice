<?php
session_start();
include_once "../includes/connect.php";
if (!isset($_SESSION["admin_id"])) {
    header("location:../login.php");
} else {
    $admin_id = $_SESSION["admin_id"];

    // IF a new course is added
    if (isset($_POST["add_course"])) {
        $faculty = $_POST["faculty"];
        $department = $_POST["department"];
        $level = $_POST["level"];
        $course_title = $_POST["course_title"];
        $course_code = $_POST["course_code"];

        $insert_into_db = mysqli_query($connect, "INSERT INTO `course` (faculty,department,level,course_title,course_code) VALUES('$faculty','$department','$level','$course_title','$course_code')");

        if ($insert_into_db) {
            echo '
            <script>
                window.location.href="./manage-course.php";
            </script>
        ';
            die();
        }
    }

    // IF a course is deleted
    if (isset($_POST["delete_course"])) {
        $course_id = $_POST["course_id"];

        $delete_frm_db = mysqli_query($connect, "DELETE FROM `course` WHERE course_id = $course_id");

        if ($delete_frm_db) {
            echo '
            <script>
                window.location.href="./manage-course.php";
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

        .btn-add {
            background-color: #1cc88a;
            color: white;
        }

        .btn-add:hover {
            background-color: #17a673;
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
                    <li class="nav-item">
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
                    <li class="nav-item active">
                        <a href="./manage-courses.php">
                            <i class="la la-book"></i>
                            <p>Manage Courses</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <div class="content">
                <div class="container">
                    <h2 class="mt-4">Manage Courses</h2>
                    <button class="btn btn-add mb-3" data-toggle="modal" data-target="#addCourseModal">Add Course</button>

                    <!-- Courses Table -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Faculty</th>
                                    <th>Department</th>
                                    <th>Level</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_frm_DB = mysqli_query($connect, "SELECT * FROM `course` ORDER BY faculty,department,level");

                                while ($row = mysqli_fetch_assoc($select_frm_DB)) {
                                ?>

                                    <tr>
                                        <td><?php echo $row["faculty"]; ?></td>
                                        <td><?php echo $row["department"]; ?></td>
                                        <td><?php echo $row["level"]; ?></td>
                                        <td><?php echo $row["course_code"]; ?></td>
                                        <td><?php echo $row["course_title"]; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger btn-delete" data-toggle="modal" data-target="#deleteCourseModal" data-id="<?php echo $row["course_id"]; ?>">Delete</button>
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

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="manage-course.php">
                        <div class="form-group">
                            <label for="faculty">Faculty</label>
                            <input type="text" class="form-control" id="faculty" name="faculty" required>
                        </div>
                        <div class="form-group">
                            <label for="department">Department</label>
                            <input type="text" class="form-control" id="department" name="department" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <input type="text" class="form-control" id="level" name="level" required>
                        </div>
                        <div class="form-group">
                            <label for="courseCode">Course Code</label>
                            <input type="text" class="form-control" id="courseCode" name="course_code" required>
                        </div>
                        <div class="form-group">
                            <label for="courseTitle">Course Title</label>
                            <input type="text" class="form-control" id="courseTitle" name="course_title" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-confirm" name="add_course">Add Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Course Modal -->
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCourseModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this course? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <form id="deleteCourseForm" method="post" action="manage-course.php">
                        <input type="hidden" name="course_id" id="courseId">
                        <button type="submit" class="btn btn-confirm" name="delete_course">Confirm</button>
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
        // Handle delete button click to set the course ID in the modal form
        $('#deleteCourseModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var courseId = button.data('id');
            var modal = $(this);
            modal.find('#courseId').val(courseId);
        });
    </script>
</body>

</html>