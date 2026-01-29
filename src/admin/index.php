<?php
session_start();

$pdo = require_once __DIR__ . '/../config/db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($email && $password) {

        $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Check password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['login_user'] = $user['name'];
            $_SESSION['user_id'] = $user['id'];

            header('Location: dashboard/index.php');
            exit;
        } else {
            $error = "Your Login Email or Password is invalid";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/images/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-300 from-blue-500 to-purple-600">

    <div class="bg-white w-full max-w-md rounded-xl shadow-2xl px-10 py-12">

        <h2 class="text-3xl font-semibold text-center mb-10 text-black">
            Login
        </h2>

        <!-- Error message -->
        <?php if (!empty($error)): ?>
            <p class="text-red-500 text-sm mb-4 text-center">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>


        <form method="post" class="space-y-6">
            <!-- Email -->
            <div>
                <input
                   name="email" placeholder="Email" required class="w-full border-0 border-b-2 border-gray-300 focus:border-purple-600 focus:ring-0 px-1 py-2 text-gray-700 placeholder-gray-400"
                >
            </div>

            <!-- Password -->
            <div>
                <input type="password" name="password" id="password"placeholder="Password" required class="w-full border-0 border-b-2 border-gray-300 focus:border-purple-600 focus:ring-0 px-1 py-2 text-gray-700 placeholder-gray-400" >
            </div>

            <!-- Button -->
            <button type="submit"  class="w-full mt-6 py-3 rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-purple-600 hover:opacity-90 transition">
                Login
            </button>
        </form>
        <!-- Links -->
        <div class="text-center text-sm text-gray-600 mt-8 space-y-2">
            <p>
                <a href="#" class="text-blue-500 hover:underline">
                    Forgot Password?
                </a>
            </p>
            <p>
                Don’t have an account?
                <a href="#" class="text-blue-500 hover:underline font-medium">
                    Sign up
                </a>
            </p>
        </div>

    </div>


</body>
</html>













