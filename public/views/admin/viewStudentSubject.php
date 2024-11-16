<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Subjects</title>
</head>
<body>
    <?php require_once 'adminNav.php'?>

    <div class='w-full sm:px-3 flex sm:justify-around justify-center flex-wrap'>
        
        <div>
            <a href=""><button class="mt-3 h-12 ml-3 bg-blue-500 text-white text-lg px-3 py-2 rounded hover:bg-blue-600" >ADD SUBJECT</button></a>
        </div>
    </div>

    <div class="flex justify-around mt-5 sm:px-3">
        <table class="w-full" id="subjectsTbl">
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