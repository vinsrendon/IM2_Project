<nav class="bg-gray-800 p-4 w-full">
    <div class="hidden sm:flex flex justify-between items-center">
        <div class="flex space-x-4">
            <a href="/dashboard" class="text-white text-lg hover:bg-gray-700 px-3 py-2 rounded">Dashboard</a>
            <a href="/profile" class="text-white text-lg hover:bg-gray-700 px-3 py-2 rounded">Profile</a>                
        </div>
        <div>                
            <button class="bg-red-500 text-white text-lg px-3 py-2 rounded hover:bg-red-600" onclick="logout()">Logout</button>
        </div>            
    </div>
    <button class="sm:hidden flex items-center text-white focus:outline-none" onclick="toggleMenu()">
        <svg class="w-7 h-7 my-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div id="mobileMenu" class="hidden sm:hidden">
        <a href="/dashboard" class="block text-white text-lg hover:bg-gray-700 px-3 py-2 rounded">Dashboard</a>
        <a href="/profile" class="block text-white text-lg hover:bg-gray-700 px-3 py-2 rounded">Profile</a>
        <button class="block bg-red-500 text-white text-lg px-3 py-2 rounded hover:bg-red-600" onclick="logout()">Logout</button>
    </div>
</nav>