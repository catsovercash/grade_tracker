<?php

include 'db.php';

if (isset($_POST['btnRegister'])) {

    $fullName = $_POST['regFullName'];
    $username = $_POST['regUsername'];
    $password = $_POST['regPassword'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $queryUser = "INSERT INTO users (full_name, username, password_hash) 
                  VALUES ('$fullName', '$username', '$hashedPassword')";

     if (mysqli_query($conn, $queryUser)) {
        $userId = mysqli_insert_id($conn);
        $roleId = 3; // default is Student

        $queryRole = "INSERT INTO user_roles (user_id, role_id) 
                      VALUES ('$userId', '$roleId')";

        mysqli_query($conn, $queryRole);
        // Redirect back to login with success
        header("Location: ../index.html?registered=success");
        exit();
        } else {
        echo "Error: " . mysqli_error($conn);
    }

}

?>
