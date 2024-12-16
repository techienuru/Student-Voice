<?php
include_once "../includes/connect.php";

if (isset($_POST['course_code'])) {
    $course_code = $_POST['course_code'];

    // Fetch the lecturer's name and ID based on the course code
    $query = "SELECT fullname, lecturer_id FROM `lecturer` WHERE course_code = '$course_code'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Return the lecturer's name and ID as a JSON object
        echo json_encode(['fullname' => $row['fullname'], 'lecturer_id' => $row['lecturer_id']]);
    } else {
        echo json_encode(['fullname' => 'Lecturer not found', 'lecturer_id' => null]);
    }
}
?>

