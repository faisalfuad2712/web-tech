<?php
// -----------------------------
// 1. Indexed array of student marks
// -----------------------------
$marks = array(65, 45, 78, 50, 90);

// Display marks using foreach loop
echo "<h3>Student Marks:</h3>";
foreach ($marks as $value) {
    echo $value . " ";
}

// -----------------------------
// 2. Function to calculate average
// -----------------------------
function calculateAverage($arr) {
    $total = 0;
    foreach ($arr as $val) {
        $total += $val;
    }
    // Type casting (int to float)
    return (float)$total / count($arr);
}

// -----------------------------
// 3. Calculate total, average, max, min
// -----------------------------
$total = 0;
$max = $marks[0];
$min = $marks[0];

foreach ($marks as $m) {
    $total += $m;

    if ($m > $max) {
        $max = $m;
    }

    if ($m < $min) {
        $min = $m;
    }
}

$average = calculateAverage($marks);

// -----------------------------
// 4. Count pass and fail
// -----------------------------
$pass = 0;
$fail = 0;

foreach ($marks as $m) {
    if ($m >= 50) {
        $pass++;
    } else {
        $fail++;
    }
}

// -----------------------------
// 5. Associative array for student details
// -----------------------------
$student = array(
    "name" => "Rahin",
    "id" => "23-53450-3",
    "cgpa" => 3.65
);

echo "<h3>Student Details:</h3>";
foreach ($student as $key => $value) {
    echo $key . " : " . $value . "<br>";
}

// -----------------------------
// 6. String operations
// -----------------------------
$nameUpper = strtoupper($student["name"]); // convert to uppercase
$nameLength = strlen($student["name"]);    // find length

echo "<h3>String Operations:</h3>";
echo "Uppercase Name: " . $nameUpper . "<br>";
echo "Name Length: " . $nameLength . "<br>";

// -----------------------------
// 7. Built-in array function
// -----------------------------
$totalStudents = count($marks);
sort($marks); // sorting array

echo "<h3>Sorted Marks:</h3>";
foreach ($marks as $m) {
    echo $m . " ";
}

// -----------------------------
// 8. Superglobal ($_GET)
// -----------------------------
$userName = isset($_GET['username']) ? $_GET['username'] : "Guest";

echo "<h3>User Input:</h3>";
echo "Hello, " . $userName . "!<br>";

// -----------------------------
// 9. Final Results
// -----------------------------
echo "<h3>Results:</h3>";
echo "Total Marks: " . $total . "<br>";
echo "Average Marks: " . $average . "<br>";
echo "Maximum Marks: " . $max . "<br>";
echo "Minimum Marks: " . $min . "<br>";
echo "Total Students: " . $totalStudents . "<br>";
echo "Passed: " . $pass . "<br>";
echo "Failed: " . $fail . "<br>";
?>