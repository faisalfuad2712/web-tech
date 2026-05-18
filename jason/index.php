<?php
// Create an array of student data
$student = array(
    "name" => "Md. Rayatul Bari Rahin",
    "id" => "23-53450-3",
    "department" => "Computer Science & Engineering",
    "cgpa" => "3.65"
);

// Set the content type to JSON
header('Content-Type: application/json');

// Convert the student data to JSON format and send it as the response
echo json_encode($student);
?>