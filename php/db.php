<?php
// db.php
$conn = mysqli_connect("localhost", "root", "", "grade_tracker");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>