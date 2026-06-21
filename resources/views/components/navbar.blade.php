<nav id="navbar"
    class="fixed top-0 left-0 w-full z-50 bg-[#FFA35C]/90 backdrop-blur-md px-4 sm:px-6 py-4 flex justify-between items-center text-white shadow-md transition-transform duration-300">
    <div class="flex items-center gap-2">
        <button id="menuBtn"
            class="text-white text-2xl cursor-pointer rounded-full p-2 hover:bg-black/10 hover:scale-110 transition">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="flex justify-center items-center h-14 overflow-visible">
                <img src="{{ asset('images/juaraASN.png') }}"
                    alt="logo"
                    class="h-12 w-auto scale-125 origin-center transition-all duration-300">
            </a>
        </div>
    </div>

    <div class="flex items-center gap-3 sm:gap-4">

        {{-- profile avatar --}}
        <a href="{{ route('edit') }}"
            class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-white flex items-center justify-center border-2 border-white hover:scale-105 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 24 24"
                class="w-6 h-6 text-[#FFA35C]">

                <path fill-rule="evenodd"
                    d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0ZM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5a18.683 18.683 0 01-7.812-1.7.75.75 0 01-.437-.695Z"
                    clip-rule="evenodd" />

            </svg>

        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="bg-white text-orange-500 px-3 sm:px-4 py-2 rounded-lg hover:bg-orange-100 transition font-medium text-sm sm:text-base">
                Logout
            </button>
        </form>

    </div>
</nav>
