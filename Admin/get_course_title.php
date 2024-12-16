<?php
include_once "../includes/connect.php";

if (isset($_POST['course_code'])) {
    $course_code = $_POST['course_code'];

    $query = "SELECT course_title, level FROM course WHERE course_code = '$course_code'";
    $result = mysqli_query($connect, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode(['course_title' => $row['course_title'], 'level' => $row['level']]);
    } else {
        echo json_encode(['course_title' => '', 'level' => '']);
    }
}
?>
