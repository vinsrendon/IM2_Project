<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
</head>
<body onload="getSubjects()">
    <?php require_once 'adminNav.php'?>  

    <div class='w-full sm:px-3 flex sm:justify-around justify-center flex-wrap'>
        <div class="mt-3 relative flex w-full sm:w-3/4 sm:h-12 rounded-lg focus-within:shadow-lg bg-blue-500 border overflow-hidden">
            <div class="grid place-items-center h-full w-12 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <input class="peer h-full w-full outline-none text-sm text-gray-700 p-2" type="text" id="search" placeholder="Search Subject..."/>            
        </div>
        <div>
            <a href="/addsubject"><button class="mt-3 sm:h-12 sm:ml-3 bg-blue-500 text-white text-sm sm:text-lg px-3 py-2 rounded hover:bg-blue-600" >ADD NEW SUBJECT</button></a>
        </div>
    </div>
    
    <div class="flex justify-around mt-5 sm:px-5 mb-5">
        <table class="w-full" id="subjectsTbl">
            <thead>
                <tr>
                    <th class="border border-amber-300 sm:p-2 text-sm sm:text-lg">Subject Code</th>
                    <th class="border border-amber-300 sm:p-2 text-sm sm:text-lg">Subject Name</th>
                    <th class="border border-amber-300 sm:p-2 text-sm sm:text-lg">Units</th>
                    <th class="border border-amber-300 sm:p-2 text-sm sm:text-lg">Course</th>
                    <th class="border border-amber-300 sm:p-2 text-sm sm:text-lg">Action</th>
                </tr>
            </thead>
            <tbody id="subjectsList">
            </tbody>
        </table>
    </div>
</body>
<script>
    document.getElementById("search").addEventListener("keypress", function (e) {
        
        const input = document.getElementById("search").value.toUpperCase();
        const table = document.getElementById("subjectsTbl");
        const rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            let cells = rows[i].getElementsByTagName("td");
            let rowContainsSearchText = false;
            
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.includes(input)) {
                    rowContainsSearchText = true;
                    break;
                }
            }
            
            rows[i].style.display = rowContainsSearchText ? "" : "none";
        }        
    });
</script>
<?php 
    require_once './public/views/dependency.php';
?>
</html>