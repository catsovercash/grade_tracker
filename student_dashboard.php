<?php
session_start();
echo "<h1>Welcome to Student Dashboard, " . $_SESSION['username'] . "!</h1>";
echo "<p>Your Role is: " . $_SESSION['role'] . "</p>";
?>