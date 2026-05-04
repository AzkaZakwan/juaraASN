<nav id="navbar"
    class="fixed top-0 left-0 w-full z-50 bg-[#FF7A47]/90 backdrop-blur-md px-4 sm:px-6 py-4 flex justify-between items-center text-white shadow-md transition-transform duration-300 duration-300">
    <div class="flex items-center gap-10">
        <button id="menuBtn"
            class="text-white text-2xl cursor-pointer rounded-full p-2 hover:bg-black/10 hover:scale-110 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logoraih.png') }}" alt="logo" class="h-12">
            </a>
        </div>
    </div>

    <div class="hidden md:flex items-center gap-6">
        <span class="font-semibold cursor-pointer">raihASN</span>

        <div class="relative cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </div>

        <img src="https://ui-avatars.com/api/?name=User&background=0D8ABC&color=fff"
            class="w-10 h-10 rounded-full border-2 border-white" alt="Profile">
    </div>
</nav>
