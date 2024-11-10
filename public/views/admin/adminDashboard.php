<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ADMIN DASHBOARD</title>
</head>
<body onload="getStudents()">
    <?php require_once 'adminNav.php'?>    

    <div class='w-full sm:px-3 flex sm:justify-around justify-center flex-wrap'>
        <div class="mt-3 relative flex w-3/4 h-12 rounded-lg focus-within:shadow-lg bg-blue-500 border overflow-hidden">
            <div class="grid place-items-center h-full w-12 text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <input class="peer h-full w-full outline-none text-sm text-gray-700 p-2" type="text" id="search" placeholder="Search Student ID..." maxlength="8"/>            
        </div>
        <div>
            <a href="/adduser"><button class="mt-3 h-12 ml-3 bg-blue-500 text-white text-lg px-3 py-2 rounded hover:bg-blue-600" >ADD STUDENT</button></a>
        </div>
    </div>

    <div class="flex justify-around mt-5 sm:px-3">
        <table class="w-full" id="studentsTbl">
            <thead>
                <tr>
                    <th class="border border-amber-300 p-2">Student ID</th>
                    <th class="border border-amber-300 p-2">Last Name</th>
                    <th class="border border-amber-300 p-2">First Name</th>
                    <th class="border border-amber-300 p-2">Middle Name</th>
                    <th class="border border-amber-300 p-2">Action</th>
                </tr>
            </thead>
            <tbody id="studentsList">
            </tbody>
        </table>
    </div>

</body>
<script>
    document.getElementById("search").addEventListener("keypress", function (e) {
        if (e.key < '0' || e.key > '9') {
            e.preventDefault();            
        }        

        const input = document.getElementById("search").value;
        const table = document.getElementById("studentsTbl");
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>