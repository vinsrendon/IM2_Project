<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>
</head>
<body>    
    <nav class="bg-gray-800 p-4 fixed w-full top-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Left Side: Home and Profile -->
            <div class="flex space-x-4">
                <a href="/dashboard" class="text-white text-lg hover:bg-gray-700 px-3 py-2 rounded">Dashboard</a>
                <a href="/profile" class="text-white text-lg hover:bg-gray-700 px-3 py-2 rounded">Profile</a>
            </div>
    
            <div>
                <button class="bg-red-500 text-white text-lg px-3 py-2 rounded hover:bg-red-600" onclick="logout()">
                    Logout
                </button>
            </div>
        </div>
    </nav>  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>