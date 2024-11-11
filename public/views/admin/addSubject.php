<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Add Subject</title>
</head>
<body>
    <?php require_once 'adminNav.php'?>

    <div class="m-5 p-6 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-2">Subject Info</h2>
        <div class="mb-4">
            <label for="subCode" class="block text-sm font-medium text-gray-700">Subject Code</label>
            <input type="text" id="subCode" name="subCode" placeholder="Enter Subject Code" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="64">
        </div>
        <div>
            <div class="flex justify-between">
                <label for="subName" class="block text-sm font-medium text-gray-700">Subject Name</label>
                </div>
                <input type="text" id="subName" name="subName" placeholder="Enter Subject Name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="128">
            </div>
        <div class="grid grid-cols-2 mb-4 gap-4">
            <div>
                <div class="flex justify-between">
                <label for="units" class="block text-sm font-medium text-gray-700">Subject Units</label>
                </div>
                <input type="text" id="units" name="units" placeholder="Enter Subject Units" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="11">
            </div>
            <div>
                <div class="flex justify-between">
                <label for="course" class="block text-sm font-medium text-gray-700">Course</label>
                </div>
                <input type="text" id="course" name="course" placeholder="Enter Subject Course" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="12">
            </div>
        </div>
        <div class="mb-5">
            <label id="fieldError" class="text-red-500 text-xs hidden">Fill all necessary fields</label>
        </div>
        
        <input type="button" value="ADD SUBJECT" onclick="addSubject()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    </div>
</body>
<script>    
    document.getElementById("units").addEventListener("keypress", function (e) {
        if (e.key < '0' || e.key > '9') {
            e.preventDefault();
        }
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>