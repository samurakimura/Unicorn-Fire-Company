<?php
// PHP can be used here to fetch dynamic data and include a shopping cart
// For now, this file serves as the main front end.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicon Fire Company - Fire Safety & Equipment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md p-4 sticky top-0 z-50">
        <nav class="container mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="assets/images/f041a22fc552663cfd486885f7ae8704_13.jpeg" alt="Unicorn Fire Company Logo" class="h-16 w-16 rounded-full shadow-lg animate-spinSlow">
                <h1 class="text-3xl font-bold text-red-600 logo-text">Unicon Fire Company</h1>
            </div>
            <div class="hidden md:flex space-x-8 text-lg font-semibold">
                <a href="customers_index.php" class="text-gray-600 hover:text-red-500 transition-colors">Home</a>
                <a href="about_page.php" class="text-gray-600 hover:text-red-500 transition-colors">About Us</a>
                <a href="services_and_equipment.php" class="text-gray-600 hover:text-red-500 transition-colors">Services & Equipment</a>
                <a href="contact_page.php" class="text-gray-600 hover:text-red-500 transition-colors">Contact</a>
                <a href="staff_index.php" class="text-green-600 hover:text-green-800 transition-colors">Staff Login</a>
            </div>
            <button id="mobile-menu-btn" class="md:hidden text-gray-600 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </nav>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white p-4 mt-2 rounded-lg shadow-lg">
            <a href="index.php" class="block py-2 text-lg font-semibold text-gray-600 hover:text-red-500">Home</a>
            <a href="about.php" class="block py-2 text-lg font-semibold text-gray-600 hover:text-red-500">About Us</a>
            <a href="services_equipment.php" class="block py-2 text-lg font-semibold text-gray-600 hover:text-red-500">Services & Equipment</a>
            <a href="contact.php" class="block py-2 text-lg font-semibold text-gray-600 hover:text-red-500">Contact</a>
            <a href="staff_index.php" class="block py-2 text-lg font-semibold text-green-600 hover:text-green-800">Staff Login</a>
        </div>
    </header>
