<?php
session_start();
include_once "includes/connect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email_matric = $_POST["email"];
  $password = $_POST["password"];

  $selecting_admin = mysqli_query($connect, "SELECT * FROM `admin` WHERE email = '$email_matric' AND password = '$password'");

  $selecting_student_affairs = mysqli_query($connect, "SELECT * FROM `student_affairs_unit` WHERE email = '$email_matric' AND password = '$password'");

  $selecting_student = mysqli_query($connect, "SELECT * FROM `student` WHERE matricno = '$email_matric' AND password = '$password'");


  if (!mysqli_num_rows($selecting_admin) > 0 && !mysqli_num_rows($selecting_student_affairs) > 0 && !mysqli_num_rows($selecting_student) > 0) {
    $error_message = '
            <div class="alert alert-danger position-absolute js-invalid-credential" style="z-index: 1; top:0;right:0;">
                Invalid Credential
            </div>
            ';

    echo '
        <script>
            setInterval(()=>{
                document.querySelector(".js-invalid-credential").style.display = "none";
            },3000);
        </script>
    ';
  } else {

    if (mysqli_num_rows($selecting_admin) > 0) {
      $row = mysqli_fetch_assoc($selecting_admin);
      $_SESSION["admin_id"] = $row["admin_id"];
      header("location:./admin/dashboard.php");
      die();
    } elseif (mysqli_num_rows($selecting_student_affairs) > 0) {
      $row = mysqli_fetch_assoc($selecting_student_affairs);
      $_SESSION["student_affairs_id"] = $row["unit_id"];
      header("location:./Staffs/dashboard.php");
      die();
    } elseif (mysqli_num_rows($selecting_student) > 0) {
      $row = mysqli_fetch_assoc($selecting_student);
      $_SESSION["student_id"] = $row["student_id"];
      header("location:./student/dashboard.php");
      die();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Student Affairs Unit</title>
  <!-- base:css -->
  <link rel="stylesheet" href="./vendors/typicons/typicons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="./images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <?php
      $error = (isset($error_message)) ? $error_message : null;
      echo $error;
      ?>
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">

              <h3>Student Affairs Unit</h3>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="login.php" method="POST">
                <div class="form-group">
                  <input type="text" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Matric No" required>
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" n id="exampleInputPassword1" placeholder="Password" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>