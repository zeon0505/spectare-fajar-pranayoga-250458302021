<nav class="bg-gray-800 text-white p-4 flex justify-between items-center">
    <div class="text-lg font-bold">🎬 CineMax</div>
    <ul class="flex space-x-6">
        <li><a href="/" class="hover:text-yellow-400">Home</a></li>
        <li><a href="/films" class="hover:text-yellow-400">Films</a></li>
        <li><a href="/about" class="hover:text-yellow-400">About</a></li>
    </ul>
    <div>
        @auth
            <a href="{{ route('logout') }}" class="text-red-400 hover:underline">Logout</a>
        @else
            <a href="{{ route('login') }}" class="hover:text-yellow-400">Login</a>
        @endauth
    </div>
</nav>
