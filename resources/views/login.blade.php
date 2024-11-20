<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {},
            },
            plugins: [daisyui],
            daisyui: {
                themes: ["light"], 
            },
        };
    </script>
    <style>
        body {
            background-image: url("motif.png");
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
            padding-bottom: 80px;
            padding-top: 60px;
            margin: 0;
            padding-bottom: 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <?php
        $password = '123';
        echo password_hash($password, PASSWORD_BCRYPT);
    ?>

    <!-- Logo -->
    <img src="asset/Cashnes/6.png" alt="Logo" class="absolute -top-7 left-5 w-28 sm:w-24 md:w-20 lg:w-28">

    <!-- Header (Teks Welcome Back!) -->
    <div class="absolute top-44 sm:top-40 lg:top-48 w-full text-center z-10">
        <h1 class="text-4xl sm:text-3xl lg:text-5xl font-bold text-[#412F26]">Welcome Back!</h1>
    </div>

    <div class="w-full sm:w-96 bg-white shadow-lg p-6 rounded-t-[40px] rounded-b-lg mx-auto z-10 relative">
        <div class="text-center mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Login</h2>
        </div>
        <form action="{{ route('login.verify') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" 
                       class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                required>
            </div>
            <button type="submit" 
                    class="w-full bg-[#412F26] text-white py-3 rounded-lg hover:bg-[#CBB89D] focus:outline-none">
                Login
            </button>
        </form>
    </div>
</body>
</html>