<?php
// login.php
session_start();
include 'db.php';
if (isset($_POST['btnLogin'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];
    // 1. Find user by username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    if ($user = mysqli_fetch_assoc($res)) {
        // 2. Check if password matches
        if (password_verify($password, $user['password_hash'])) {
            
            $userId = $user['user_id'];
            // 3. Get the user's role from user_roles and roles table
            $roleQuery = "SELECT r.role_name 
                          FROM user_roles ur 
                          JOIN roles r ON ur.role_id = r.role_id 
                          WHERE ur.user_id = '$userId'";
            $roleRes = mysqli_query($conn, $roleQuery);
            $roleRow = mysqli_fetch_assoc($roleRes);
            $roleName = $roleRow['role_name']; // 'Student' or 'Teacher' or 'Admin'
            // 4. Store in session
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $roleName;
            $_SESSION['full_name'] = $user['full_name'];
            // 5. Role-based redirect!
            if ($roleName == 'Teacher' || $roleName == 'Admin') {
                header("Location: ../professor_dashboard.php");
            } else {
                header("Location: ../student_dashboard.php");
            }
            exit();
            
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "User not found!";
    }
}
?>