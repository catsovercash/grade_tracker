<?php
session_start();
include 'db.php';

if (isset($_POST['btnPublishTemplate'])) {

    $userId = $_SESSION['user_id'];
    $courseCode = $_POST['courseCode'];
    $courseTitle = $_POST['courseTitle'];

    // Generate class code, e.g. CS301-SEC5
    $cleanCode = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $courseCode));
    $classCode = $cleanCode . "-SEC" . rand(1, 9);

    // 1. Insert into grade_templates table
    $queryTemplate = "INSERT INTO grade_templates (user_id, course_code, course_title, class_code) 
                      VALUES ('$userId', '$courseCode', '$courseTitle', '$classCode')";

    if (mysqli_query($conn, $queryTemplate)) {
        // 2. Get the new template_id
        $templateId = mysqli_insert_id($conn);

        // 3. Insert each component and its weight using component_id
        $componentIds = $_POST['component_id'];
        $weights = $_POST['weight'];

        for ($i = 0; $i < count($componentIds); $i++) {
            $compId = $componentIds[$i];
            $weight = $weights[$i];

            $queryItem = "INSERT INTO template_components (template_id, component_id, weight) 
                          VALUES ('$templateId', '$compId', '$weight')";
            mysqli_query($conn, $queryItem);
        }

        // Redirect back to dashboard with success
        header("Location: ../student_dashboard.php?template=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
