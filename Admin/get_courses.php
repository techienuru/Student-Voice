<?php
include_once "../includes/connect.php";

if (isset($_POST['faculty'])) {
    $faculty = $_POST['faculty'];

    // Fetch departments based on faculty
    $department_query = "SELECT DISTINCT department FROM course WHERE faculty = '$faculty'";
    $departments_result = mysqli_query($connect, $department_query);

    $departments = [];
    while ($row = mysqli_fetch_assoc($departments_result)) {
        $departments[] = $row['department'];
    }

    // Fetch courses based on faculty
    $course_query = "SELECT course_code, course_title FROM course WHERE faculty = '$faculty'";
    $courses_result = mysqli_query($connect, $course_query);

    $courses = [];
    while ($row = mysqli_fetch_assoc($courses_result)) {
        $courses[] = $row;
    }

    // Return the data as JSON
    echo json_encode(['departments' => $departments, 'courses' => $courses]);
}
