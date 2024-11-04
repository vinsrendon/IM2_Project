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

    <div class="flex justify-around mt-5 sm:px-5">
        <table class="w-full" id="studentsList">
            <thead>
                <tr>
                    <th class="border border-amber-300 p-2">Student ID</th>
                    <th class="border border-amber-300 p-2">Last Name</th>
                    <th class="border border-amber-300 p-2">First Name</th>
                    <th class="border border-amber-300 p-2">Middle Name</th>
                    <th class="border border-amber-300 p-2">Action</th>
                </tr>
            </thead>
        </table>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>