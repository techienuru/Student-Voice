<?php
session_start();
include_once "../includes/connect.php";
if (!isset($_SESSION["admin_id"])) {
    header("location:../login.php");
} else {
    $admin_id = $_SESSION["admin_id"];

    // IF a new member is added
    if (isset($_POST["add_member"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $insert_into_db = mysqli_query($connect, "INSERT INTO `student_affairs_unit` (fullname,email,password) VALUES('$name','$email','$password')");

        if ($insert_into_db) {
            echo '
            <script>
                window.location.href="./manage-staff.php";
            </script>
        ';
            die();
        }
    }

    // IF a member details is updated
    if (isset($_POST["edit_member"])) {
        $unit_id = $_POST["unit_id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $insert_into_db = mysqli_query($connect, "UPDATE `student_affairs_unit` SET fullname ='$name', email = '$email', password = '$password' WHERE unit_id = $unit_id");

        if ($insert_into_db) {
            echo '
            <script>
                window.location.href="./manage-staff.php";
            </script>
        ';
            die();
        }
    }

    // IF a member is deleted
    if (isset($_POST["delete_member"])) {
        $unit_id = $_POST["unit_id"];

        $delete_frm_db = mysqli_query($connect, "DELETE FROM `student_affairs_unit` WHERE unit_id = $unit_id");

        if ($delete_frm_db) {
            echo '
            <script>
                window.location.href="./manage-staff.php";
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
                    <h2 class="mt-4">Add a Member of Student Affairs Unit</h2>
                    <form id="add-member-form" action="manage-staff.php" method="POST" class="mb-4">
                        <div class="form-group">
                            <label for="member-name">Name</label>
                            <input type="text" class="form-control" id="member-name" name="name" placeholder="Enter name" required>
                        </div>
                        <div class="form-group">
                            <label for="member-email">Email</label>
                            <input type="email" class="form-control" id="member-email" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="member-password">Password</label>
                            <input type="password" class="form-control" id="member-password" name="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" class="btn btn-success" name="add_member">Add Member</button>
                    </form>

                    <h4>Current Members</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="members-list">
                                <?php
                                $select_frm_DB = mysqli_query($connect, "SELECT * FROM `student_affairs_unit`");

                                $number = 1;
                                while ($row = mysqli_fetch_assoc($select_frm_DB)) {
                                ?>

                                    <tr>
                                        <td><?php echo $number; ?></td>
                                        <td><?php echo $row["fullname"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td class="d-flex">
                                            <button type="button" data-toggle="modal" data-target="#editMemberModal<?php echo $row["unit_id"] ?>" class="btn btn-sm btn-warning mr-3">Edit</button>
                                            <form action="manage-staff.php" method="POST">
                                                <input type="hidden" value="<?php echo $row["unit_id"]; ?>" name="unit_id">
                                                <button type="submit" name="delete_member" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Edit Member Modal -->
                                    <div class="modal fade" id="editMemberModal<?php echo $row["unit_id"] ?>" tabindex="-1" role="dialog" aria-labelledby="editMemberLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editMemberLabel">Edit Member</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="edit-member-form" action="manage-staff.php" method="POST">
                                                        <input type="hidden" value="<?php echo $row["unit_id"]; ?>" name="unit_id">
                                                        <div class="form-group">
                                                            <label for="edit-member-name">Name</label>
                                                            <input type="text" class="form-control" id="edit-member-name" value="<?php echo $row["fullname"]; ?>" name="name" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-member-email">Email</label>
                                                            <input type="email" class="form-control" id="edit-member-email" value="<?php echo $row["email"]; ?>" name="email" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="edit-member-password">Password</label>
                                                            <input type="password" class="form-control" id="edit-member-password" name="password">
                                                        </div>
                                                        <input type="hidden" id="edit-member-id" name="id">
                                                        <button type="submit" class="btn btn-success" name="edit_member">Update Member</button>
                                                    </form>
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