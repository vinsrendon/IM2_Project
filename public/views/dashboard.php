<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>
</head>
<body onload="getStudSub(<?php echo $_SESSION['stud_id']?>,<?php echo $_SESSION['Role']?>)">    
    <?php require_once 'userNav.php'?>   

    <h1 class="text-center text-xl mt-2">STUDENT ID: <?php echo $_SESSION['stud_id']?></>
    <div class="flex justify-around mt-5 sm:px-12">
        <table class="w-full" id="subjectsTbl">
            <thead>
                <tr>
                    <th class="border border-amber-300 sm:p-2 text-xs sm:text-lg">Subject Code</th>
                    <th class="border border-amber-300 sm:p-2 text-xs sm:text-lg">Subject Name</th>
                    <th class="border border-amber-300 sm:p-2 text-xs sm:text-lg">Units</th>
                    <th class="border border-amber-300 sm:p-2 text-xs sm:text-lg">Time</th>
                    <th class="border border-amber-300 sm:p-2 text-xs sm:text-lg">Day</th>
                    <th class="border border-amber-300 sm:p-2 text-xs sm:text-lg">Room</th>
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