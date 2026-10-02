<?php
<<<<<<< Updated upstream
=======
// publish_template.php
>>>>>>> Stashed changes
session_start();
include 'db.php';

if (isset($_POST['btnPublishTemplate'])) {
<<<<<<< Updated upstream

    $userId = $_SESSION['user_id'];
    $courseCode = $_POST['courseCode'];
    $courseTitle = $_POST['courseTitle'];
=======
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.html");
        exit();
    }

    $userId = $_SESSION['user_id'];
    $courseCode = trim($_POST['courseCode'] ?? '');
    $courseTitle = trim($_POST['courseTitle'] ?? '');
>>>>>>> Stashed changes

    // Generate class code, e.g. CS301-SEC5
    $cleanCode = strtoupper(preg_replace('/[^a-zA-Z0-9]/', '', $courseCode));
    $classCode = $cleanCode . "-SEC" . rand(1, 9);

    // 1. Insert into grade_templates table
<<<<<<< Updated upstream
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
=======
    $stmtTpl = mysqli_prepare($conn, "INSERT INTO grade_templates (user_id, course_code, course_title, class_code) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmtTpl, "isss", $userId, $courseCode, $courseTitle, $classCode);

    if (mysqli_stmt_execute($stmtTpl)) {
        $templateId = mysqli_insert_id($conn);

        // 2. Insert each component and its weight using component_name
        $componentNames = $_POST['component_name'] ?? $_POST['component_id'] ?? [];
        $weights = $_POST['weight'] ?? [];

        $stmtComp = mysqli_prepare($conn, "INSERT INTO template_components (template_id, component_name, weight) VALUES (?, ?, ?)");

        for ($i = 0; $i < count($componentNames); $i++) {
            $compName = trim((string)$componentNames[$i]);
            $weight = (int)($weights[$i] ?? 0);

            if (!empty($compName)) {
                mysqli_stmt_bind_param($stmtComp, "isi", $templateId, $compName, $weight);
                mysqli_stmt_execute($stmtComp);
            }
>>>>>>> Stashed changes
        }

        // Redirect back to dashboard with success
        header("Location: ../student_dashboard.php?template=success");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
