<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <link href="../assets/css/tailwind.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-300 from-blue-500 to-purple-600">

    <div class="bg-white w-full max-w-md rounded-xl shadow-2xl px-10 py-12">

        <h2 class="text-3xl font-semibold text-center mb-10 text-black">
            Login
        </h2>

        <!-- Error message -->
        <p id="errorMsg" class="hidden text-red-500 text-sm mb-4 text-center">
            Invalid email or password
        </p>

        <form id="loginForm" class="space-y-6">
            <!-- Email -->
            <div>
                <input
                    type="email"
                    id="email"
                    placeholder="Email"
                    required
                    class="w-full border-0 border-b-2 border-gray-300 focus:border-purple-600 focus:ring-0 px-1 py-2 text-gray-700 placeholder-gray-400"
                >
            </div>

            <!-- Password -->
            <div>
                <input
                    type="password"
                    id="password"
                    placeholder="Password"
                    required
                    class="w-full border-0 border-b-2 border-gray-300 focus:border-purple-600 focus:ring-0 px-1 py-2 text-gray-700 placeholder-gray-400"
                >
            </div>

            <!-- Button -->
            <button
                type="submit"
                class="w-full mt-6 py-3 rounded-md text-white font-medium
                       bg-gradient-to-r from-blue-500 to-purple-600
                       hover:opacity-90 transition"
            >
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

    <!-- JS -->
    <script>
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Demo login (replace with PHP later)
            if (email === 'admin@example.com' && password === 'admin123') {
                window.location.href = 'dashboard.php';
            } else {
                document.getElementById('errorMsg').classList.remove('hidden');
            }
        });
    </script>

</body>
</html>













