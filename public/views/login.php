<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>LOGIN</title>   
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
<div id="app"></div>
<div class="m-5 p-6 bg-white p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-center mb-2">Students Directory</h2>
    <p class="text-center text-gray-500 mb-6">
      Please sign-in to your account and start browsing your student information
    </p>
    
      <div class="mb-4">
        <label for="studentId" class="block text-sm font-medium text-gray-700">Student ID</label>
        <input type="text" id="studentId" name="studentId" placeholder="Enter Student ID" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
        <small id="userError" class="text-red-500 text-xs hidden">Please enter your Student ID.</small>  
    </div>

      <div class="mb-4">
        <div class="flex justify-between">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        </div>
        <input type="password" id="pass" name="pass" placeholder="••••••••" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
        <small id="passError" class="text-red-500 text-xs hidden">Please enter your password.</small>
      </div>

      <input id="loginBtn" type="button" value="LOGIN" onclick="login()" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
    
    <p class="mt-6 text-center text-sm text-gray-500">
      Account problems?, you can approach us at the registrar office
    </p>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="./public/lib/js/index.js"></script>
</html>