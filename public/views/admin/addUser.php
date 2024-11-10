<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>    
    <?php require_once 'adminNav.php'?>

    <div class="m-5 p-6 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-2">User Info</h2>
        <div class="mb-4">
            <label for="sid" class="block text-sm font-medium text-gray-700">Student ID</label>
            <input type="text" id="sid" name="sid" placeholder="Enter Student ID" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="8">
        </div>
        <div class="grid grid-cols-2 mb-4 gap-4">
            <div>
                <div class="flex justify-between">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                </div>
                <input type="password" id="password" name="password" placeholder="••••••••" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <div class="flex justify-between">
                <label for="passwordC" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                </div>
                <input type="password" id="passwordC" name="passwordC" placeholder="••••••••" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>
        <div class="grid grid-cols-3 mb-4 gap-4">
            <div>
                <label for="fname" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="fname" name="fname" placeholder="Enter first name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocapitalize="true">
            </div>
            <div>
                <label for="mname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" id="mname" name="mname" placeholder="Enter middle name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocapitalize="true">
            </div>
            <div>
                <label for="lname" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" id="lname" name="lname" placeholder="Enter last name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocapitalize="true">
            </div>
        </div>

        <div class="mb-4">
            <label for="DOB" class="block text-sm font-medium text-gray-700">Date of Birth</label>
            <input type="date" id="DOB" name="DOB" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="256">
        </div>

        <div class="mb-10">
            <label for="pnumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" id="pnumber" name="pnumber" placeholder="Enter phone number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="11">
        </div>

        <h2 class="text-2xl font-semibold text-center mb-2">User Guardian Info</h2>
        <div class="grid grid-cols-3 mb-4 gap-4">
            <div>
                <label for="gfname" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" id="gfname" name="gfname" placeholder="Enter first name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocapitalize="true">
            </div>
            <div>
                <label for="gmname" class="block text-sm font-medium text-gray-700">Middle Name</label>
                <input type="text" id="gmname" name="gmname" placeholder="Enter middle name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocapitalize="true">
            </div>
            <div>
                <label for="glname" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" id="glname" name="glname" placeholder="Enter last name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" autocapitalize="true">
            </div>
        </div>

        <div class="mb-4">
            <label for="gaddress" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" id="gaddress" name="gaddress" placeholder="Enter address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="256">
        </div>

        <div class="mb-10">
            <label for="gpnumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
            <input type="text" id="gpnumber" name="gpnumber" placeholder="Enter phone number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="11">
        </div>
        <div class="mb-5">
            <label id="passError" class="text-red-500 text-xs hidden">Password doesn't match</label>
            <label id="fieldError" class="text-red-500 text-xs hidden">Fill necessary all fields</label>
        </div>
        
        <input type="button" value="REGISTER" onclick="addUser()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    </div>
</body>
<script>
    const numsOnlyIds = ["sid", "pnumber", "gpnumber"];

numsOnlyIds.forEach((id) => {
    document.getElementById(id).addEventListener("keypress", function (e) {
        if (e.key < '0' || e.key > '9') {
            e.preventDefault();
        }
    });
});

const AlphaOnlyIds = ["fname", "mname", "lname","gfname", "gmname", "glname"];

AlphaOnlyIds.forEach((id) => {
    document.getElementById(id).addEventListener("keypress", function (e) {
        if (!/[a-zA-Z]/.test(e.key)) {
            e.preventDefault();
        }
    });
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>