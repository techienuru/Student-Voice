<?php
include("includes/connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $fullname = $_POST["fullname"];
  $matricno = $_POST["matricno"];
  $faculty = $_POST["faculty"];
  $department = $_POST["department"];
  $level = $_POST["level"];
  $password = $_POST["password"];

  $sql = mysqli_query($connect, "INSERT INTO `student` (fullname,matricno,faculty,department,level,password) VALUES('$fullname','$matricno','$faculty','$department','$level','$password')");

  if ($sql) {
    echo '
            <script>
                alert("Acount Creation Successful");
                window.location.href="./login.php";
            </script>
        ';
    die();
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
  <link rel="shortcut icon" href="./images/faces/" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="pt-3" action="register.php" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputFullname" name="fullname" placeholder="Full name" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputMatricno" name="matricno" placeholder="Matric No" required>
                </div>

                <div class="form-group">
                  <label for="studentdepartment">Select Faculty</label>
                  <?php
                  $select_faculties = mysqli_query($connect, "SELECT DISTINCT(faculty) AS faculty FROM `course`");
                  ?>
                  <select class="form-control form-control-lg" id="faculty" name="faculty" required>
                    <option value="------">------</option>
                    <?php
                    while ($row = mysqli_fetch_assoc($select_faculties)) {
                    ?>
                      <option value="<?php echo $row["faculty"]; ?>"><?php echo $row["faculty"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="studentdepartment">Select department</label>
                  <select class="form-control form-control-lg" id="department" name="department" required>
                    <option value="------">------</option>
                    <!-- Options will be dynamically loaded here -->
                  </select>
                </div>

                <div class="form-group">
                  <label for="studentLevel">Select Level</label>
                  <select class="form-control form-control-lg" id="studentLevel" name="level" required>
                    <option value="------">------</option>
                    <option value="100">100 Level</option>
                    <option value="200">200 Level</option>
                    <option value="300">300 Level</option>
                    <option value="400">400 Level</option>
                    <option value="500">500 Level</option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputMatricno" name="password" placeholder="password" required>
                </div>

                <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign Up</button>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.php" class="text-primary">Login</a>
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
  <script>
    document.getElementById('faculty').addEventListener('change', function() {
      var faculty = this.value;
      var departmentSelect = document.getElementById('department');

      // Clear current department options
      departmentSelect.innerHTML = '<option value="------">------</option>';

      if (faculty !== '------') {
        // Fetch departments based on the selected faculty
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'fetch_departments.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
          if (this.status === 200) {
            var departments = JSON.parse(this.responseText);
            departments.forEach(function(department) {
              var option = document.createElement('option');
              option.value = department;
              option.text = department;
              departmentSelect.add(option);
            });
          }
        };
        xhr.send('faculty=' + faculty);
      }
    });
  </script>

</body>

</html>