<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard - Grade Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body class="bg-[#f8f6f2] font-sans text-slate-800 min-h-screen flex flex-col">
    <header class="bg-[#4a0415] text-white h-16 flex items-center justify-between px-6 shadow-md">
        <div class="flex items-center space-x-3">
            <div class="w-9 h-9 rounded-full bg-white/10 flex items-center justify-center font-bold text-sm border border-white/20">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <span class="font-extrabold text-base tracking-wide">Professor Portal</span>
        </div>
        <div class="flex items-center space-x-6">
            <span class="font-semibold text-sm">Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?></span>
            <a href="php/logout.php" class="text-xs font-semibold text-rose-200 hover:text-white transition flex items-center space-x-1.5 bg-white/10 px-3 py-1.5 rounded-lg border border-white/20">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </div>
    </header>

    <main class="flex-1 p-8 max-w-5xl mx-auto w-full space-y-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-200">
            <h1 class="text-2xl font-bold text-slate-900 mb-2">Welcome to Professor Dashboard, <?php echo htmlspecialchars($_SESSION['full_name'] ?? $_SESSION['email']); ?>!</h1>
            <p class="text-sm text-stone-600">Your role: <span class="font-bold text-[#6b0820]"><?php echo htmlspecialchars($_SESSION['role']); ?></span></p>
            <p class="text-xs text-stone-400 mt-1">Email: <?php echo htmlspecialchars($_SESSION['email']); ?> | Account ID: #<?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
        </div>
    </main>
</body>
</html>