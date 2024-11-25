<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Subjects</title>
</head>
<body onload="getStudSub(<?php echo $_SESSION['stud_id_to_get_sub']?>,<?php echo $_SESSION['Role']?>),loadSubjects()">
    <?php require_once 'adminNav.php'?>
    <!-- <h1 class="text-center text-md mt-2">STUDENT ID: <?php echo $_SESSION['stud_id_to_get_sub']?></h1> -->
    <div class="flex justify-around sm:px-3">    
        <div class="xl:w-4/5 w-full p-4 bg-white rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-center mb-2">STUDENT ID: <?php echo $_SESSION['stud_id_to_get_sub']?> - ADD / REMOVE LOAD </h2>
            <div class="mb-2 flex flex-wrap mb-4 gap-4">                
                <select name="subjects" id="subToAdd" class=" sm:flex-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </select>
                <select onchange="setTime()" name="day" id="day" class=" sm:flex-1 w-full block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="" disabled selected>Select Day</option>
                    <option value="MWF">MWF</option>
                    <option value="TTH">TTH</option>
                    <option value="SAT">SAT</option>
                </select>
            </div>
            <div class="mb-2 flex mb-4 gap-4">
                <select name="time" id="time" class=" sm:flex-1 w-full block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="" disabled selected>Select Time</option>
                </select>
                <select name="room" id="room" class=" sm:flex-1 w-full block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="" disabled selected>Select Room</option>
                    <option value="LAB1">LAB 1</option>
                    <option value="LAB2">LAB 2</option>
                    <option value="LAB3">LAB 3</option>
                    <option value="101">101</option>
                    <option value="201">201</option>
                    <option value="202">202</option>
                    <option value="203">203</option>
                    <option value="301">301</option>
                    <option value="302">302</option>
                    <option value="303">303</option>
                    <option value="401">401</option>
                    <option value="402">402</option>
                    <option value="403">403</option>
                    <option value="RD1">RD1</option>
                    <option value="RD2">RD2</option>
                    <option value="RD3">RD3</option>
                    <option value="TENT1">TENT 1</option>
                    <option value="TENT2">TENT 2</option>
                    <option value="TENT3">TENT 3</option>
                </select>
            </div>
            <div class="mb-2">
                <label id="fieldError" class="text-red-500 text-sm hidden">Please select a subject to add</label>
            </div>
            
            <input type="button" value="ADD SUBJECT" onclick="addSubjectToUser(<?php echo $_SESSION['stud_id_to_get_sub']?>,<?php echo $_SESSION['Role']?>)" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        </div>
    </div>
    <div class="flex justify-around mt-5 sm:px-3">
        <table class="xl:w-4/5 w-full" id="subjectsTbl">
            <thead>
                <tr>
                    <th class="border border-amber-300 p-2 text-sm sm:text-lg">Subject Code</th>
                    <th class="border border-amber-300 p-2 text-sm sm:text-lg">Subject Name</th>
                    <th class="border border-amber-300 p-2 text-sm sm:text-lg">Subject Units</th>
                    <th class="border border-amber-300 p-2 text-sm sm:text-lg">Time</th>
                    <th class="border border-amber-300 p-2 text-sm sm:text-lg">Day</th>
                    <th class="border border-amber-300 p-2 text-sm sm:text-lg">Room</th>
                    <th class="border border-amber-300 p-2 text-sm sm:text-lg">Action</th>
                </tr>
            </thead>
            <tbody id="subjectsList">
            </tbody>
        </table>
    </div>
</body>
<?php 
    require_once './public/views/dependency.php';
?>
</html>