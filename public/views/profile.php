<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PROFILE</title>
</head>
<body>
    <?php require_once 'userNav.php'?>   
    
    <div class="px-4 py-5 sm:px-6 bg-green-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            User Profile
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            This is some information about the user.
        </p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
        <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Student ID
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php echo $_SESSION['stud_id']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    First Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php echo $_SESSION['fname']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Middle Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php echo $_SESSION['mname']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Last Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php echo $_SESSION['lname']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Address
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <?php echo $_SESSION['address']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Date of Birth
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <?php echo date("F j, Y", strtotime($_SESSION['DOB']))?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Phone Number
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <?php echo $_SESSION['pnumber']?>
                </dd>
            </div>
        </dl>
    </div>
    
    <div class="px-4 py-5 sm:px-6 bg-green-200">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
            User's Guardian Profile
        </h3>
        <p class="mt-1 max-w-2xl text-sm text-gray-500">
            This is some information about the user's guardian.
        </p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    First Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php echo $_SESSION['gfname']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Middle Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php echo $_SESSION['gmname']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Last Name
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <?php echo $_SESSION['glname']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Address
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <?php echo $_SESSION['gaddress']?>
                </dd>
            </div>
            <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Phone Number
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                <?php echo $_SESSION['gpnumber']?>
                </dd>
            </div>
        </dl>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.all.min.js "></script>
</html>