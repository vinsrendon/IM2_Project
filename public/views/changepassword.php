<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <title><?php echo $_SESSION['Role']===1? 'Admin ': 'User ';?>Change Password</title>
</head>
<body>
    <?php 
        if($_SESSION['Role'] === 1){
            require $_SERVER['DOCUMENT_ROOT'].'/public/views/admin/adminNav.php';
        }
        else{
            require 'userNav.php';
        }
    ?>

    <div class="m-5 p-6 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-2">Change password</h2>
        <div class="mb-4">
            <label for="oldPass" class="block text-sm font-medium text-gray-700">Old Password</label>
            <input type="password" id="oldPass" name="oldPass" placeholder="••••••••" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="64">
        </div>
        <div class="mb-4">
            <div class="flex justify-between">
                <label for="newPass" class="block text-sm font-medium text-gray-700">New Password</label>
                </div>
                <input type="password" id="newPass" name="newPass" placeholder="••••••••" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="128">
        </div>
        <div>
            <div class="flex justify-between">
                <label for="newPassC" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                </div>
                <input type="password" id="newPassC" name="newPassC" placeholder="••••••••" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="128">
        </div>
        <div class="mb-5">
            <label id="fieldError" class="text-red-500 text-xs hidden">Fill all necessary fields</label>
        </div>
        
        <input id="changeBtn" type="button" value="CHANGE" onclick="changePassword()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    </div>
</body>
<?php 
    require_once './public/views/dependency.php';
?>
</html>