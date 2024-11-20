<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Subjects</title>
</head>
<body onload="getStudSub(<?php echo $_SESSION['stud_id_to_get_sub']?>),loadSubjects()">
    <?php require_once 'adminNav.php'?>
    <h1 class="text-center text-xl mt-2">STUDENT ID: <?php echo $_SESSION['stud_id_to_get_sub']?></h1>
    <div class="flex justify-around sm:px-3">    
        <div class="xl:w-4/5 w-full p-4 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-center mb-2">Select Subject</h2>
            <div class="mb-2">                
                <select name="subjects" id="subToAdd" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                </select>
            </div>
            <div class="mb-2">
                <label id="fieldError" class="text-red-500 text-sm hidden">Please select a subject to add</label>
            </div>
            
            <input type="button" value="ADD SUBJECT" onclick="addSubjectToUser(<?php echo $_SESSION['stud_id_to_get_sub']?>)" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        </div>
    </div>
    <div class="flex justify-around mt-5 sm:px-3">
        <table class="xl:w-4/5 w-full" id="subjectsTbl">
            <thead>
                <tr>
                    <th class="border border-amber-300 p-2">Subject Code</th>
                    <th class="border border-amber-300 p-2">Subject Name</th>
                    <th class="border border-amber-300 p-2">Subject Units</th>
                    <th class="border border-amber-300 p-2">Room</th>
                    <th class="border border-amber-300 p-2">Action</th>
                </tr>
            </thead>
            <tbody id="subjectsList">
            </tbody>
        </table>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>