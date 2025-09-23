<?php
// Start a PHP session to manage user state
session_start();

// Check if the user is already logged in
if (isset($_SESSION['staff_logged_in']) && $_SESSION['staff_logged_in'] === true) {
    // If logged in, show the dashboard
    $is_logged_in = true;
    $welcome_message = "Welcome, Staff Member";
} else {
    // Check for form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Hardcoded credentials for demonstration purposes
        // In a real system, you would query a database and check a hashed password.
        $valid_email = 'mikemunyuakimura@gmail.com';
        $valid_password = 'mike123';

        if ($email === $valid_email && $password === $valid_password) {
            // Login successful
            $_SESSION['staff_logged_in'] = true;
            $is_logged_in = true;
            $welcome_message = "Welcome, Mike";
        } else {
            // Login failed
            $login_error = "Invalid email or password.";
            $is_logged_in = false;
        }
    } else {
        $is_logged_in = false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unicorn Fire - Staff Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .bg-fire-gradient {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Header -->
    <header class="bg-white shadow-md p-4 sticky top-0 z-50">
        <nav class="container mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <img src="https://placehold.co/64x64/dc2626/ffffff?text=UFC" alt="Unicorn Fire Company Logo" class="h-16 w-16 rounded-full shadow-lg">
                <h1 class="text-3xl font-bold text-red-600 logo-text">Staff Dashboard</h1>
            </div>
            <div class="flex space-x-4">
                <?php if ($is_logged_in): ?>
                    <span id="welcome-message" class="text-gray-600 text-lg font-semibold"><?php echo $welcome_message; ?></span>
                    <a href="logout.php" id="logout-btn" class="bg-red-500 text-white font-bold py-2 px-4 rounded-full hover:bg-red-600 transition-colors">Log Out</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>

    <main class="container mx-auto px-4 py-8">
        
        <?php if ($is_logged_in): ?>
            <!-- Dashboard Content -->
            <div id="dashboard-content" class="space-y-8">
                <h2 class="text-4xl font-bold text-center text-red-700 mb-10">Admin & Staff Portal</h2>

                <!-- Requests Section -->
                <section class="bg-white p-6 rounded-3xl shadow-lg">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Customer Requests <span id="request-count" class="text-red-500">(0)</span></h3>
                    <div id="requests-list" class="space-y-4">
                        <!-- Requests will be populated here -->
                    </div>
                </section>

                <!-- Product Management Section -->
                <section class="bg-white p-6 rounded-3xl shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">Product Management</h3>
                        <button id="add-product-btn" class="bg-green-600 text-white font-bold py-2 px-4 rounded-full hover:bg-green-700 transition-colors">Add New Product</button>
                    </div>
                    <div id="product-list" class="space-y-4">
                        <!-- Products will be populated here -->
                    </div>
                </section>
            </div>
        <?php else: ?>
            <!-- Login Form -->
            <div class="flex flex-col items-center justify-center p-8 bg-white rounded-lg shadow-lg max-w-md mx-auto">
                <h2 class="text-3xl font-bold text-red-700 mb-4">Staff Login</h2>
                <?php if (isset($login_error)): ?>
                    <div class="bg-red-200 text-red-800 p-3 rounded-lg w-full text-center mb-4"><?php echo $login_error; ?></div>
                <?php endif; ?>
                <form action="staff_index.php" method="POST" class="w-full space-y-4">
                    <input type="email" name="email" placeholder="Email" class="w-full p-3 border border-gray-300 rounded-lg">
                    <input type="password" name="password" placeholder="Password" class="w-full p-3 border border-gray-300 rounded-lg">
                    <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 rounded-lg hover:bg-red-700 transition-colors">Login</button>
                </form>
            </div>
        <?php endif; ?>

    </main>

    <footer class="bg-gray-800 text-white p-6 text-center rounded-t-3xl mt-8">
        <p>&copy; 2023 Unicorn Fire Company. All rights reserved.</p>
    </footer>

</body>
</html>
