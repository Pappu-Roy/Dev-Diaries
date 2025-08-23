<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Check if the user is logged in
$is_admin_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dev Diaries</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" xintegrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Custom styles for the dropdown menu */
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gradient-to-r from-blue-900 to-slate-900 shadow-lg">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <a href="index.php" class="text-white text-2xl font-bold tracking-wide hover:text-gray-200 transition-colors">
                Dev Diaries
            </a>

            <div class="flex items-center space-x-6">
                <a href="index.php" class="text-white text-lg font-semibold hover:text-gray-200 transition-colors">
                    Home
                </a>
                
                <!-- Posts Dropdown Menu -->
                <div class="relative dropdown">
                    <button class="text-white text-lg font-semibold hover:text-gray-200 transition-colors flex items-center">
                        Posts <i class="fas fa-caret-down ml-2"></i>
                    </button>
                    <div class="dropdown-menu absolute hidden text-gray-700 pt-1 w-48 z-10">
                        <ul class="bg-white rounded-lg shadow-xl overflow-hidden">
                            <li><a class="block px-4 py-2 hover:bg-gray-200" href="index.php?category=Science">Science</a></li>
                            <li><a class="block px-4 py-2 hover:bg-gray-200" href="index.php?category=Technology">Technology</a></li>
                            <li><a class="block px-4 py-2 hover:bg-gray-200" href="index.php?category=Programming">Programming</a></li>
                            <li><a class="block px-4 py-2 hover:bg-gray-200" href="index.php?category=News">News</a></li>
                        </ul>
                    </div>
                </div>

                <a href="about.php" class="text-white text-lg font-semibold hover:text-gray-200 transition-colors">
                    About
                </a>

                <?php if ($is_admin_logged_in): ?>
                    <a href="dashboard.php" class="py-2 px-4 text-white font-semibold rounded-full bg-blue-600 hover:bg-blue-800 transition-colors duration-300">
                        Dashboard
                    </a>
                    <a href="logout.php" class="py-2 px-4 bg-red-500 text-white font-semibold rounded-full hover:bg-red-600 transition-colors duration-300">
                        Logout
                    </a>
                <?php else: ?>
                    <a href="admin.php" class="py-2 px-4 text-white font-semibold rounded-full bg-green-600 hover:bg-green-800 transition-colors duration-300">
                        Admin Login
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main class="mt-24">
