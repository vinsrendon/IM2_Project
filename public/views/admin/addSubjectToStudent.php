<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>

    <title>Add Subject To Student</title>
</head>
<body onload="loadSubjects()">
    <?php require_once 'adminNav.php'?>
    <h1 class="text-center text-xl mt-2">STUDENT ID: <?php echo $_SESSION['stud_id_to_get_sub']?></h1>
    <div class="m-5 p-6 bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center mb-2">Subject Info</h2>
        <div class="mb-4">
            <label for="subCode" class="block text-lg font-medium text-gray-700">Subject</label>
            <!-- <input type="text" id="subCode" name="subCode" placeholder="Enter Subject Code" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" maxlength="64"> -->
            <select name="subjects" id="subToAdd" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

            </select>
        </div>
        <div class="mb-5">
            <label id="fieldError" class="text-red-500 text-sm hidden">Please select a subject to add</label>
        </div>
        
        <input type="button" value="ADD SUBJECT" onclick="addSubjectToUser()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>