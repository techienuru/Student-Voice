<?php
include("includes/connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $faculty = mysqli_real_escape_string($connect, $_POST['faculty']);

  $result = mysqli_query($connect, "SELECT DISTINCT(department) FROM `course` WHERE faculty='$faculty'");
  $departments = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row['department'];
  }

  echo json_encode($departments);
}
?>
